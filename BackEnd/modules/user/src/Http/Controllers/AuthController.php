<?php

namespace Modules\User\Http\Controllers;

use Core\Supports\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Repositories\Interfaces\RoleInterface;
use Modules\User\Repositories\Interfaces\UserInfoInterface;
use Modules\User\Repositories\Interfaces\UserInterface;
use Socialite;

class AuthController extends BaseController
{
    protected $userRepository;

    protected $roleRepository;

    protected $userInfoRepository;

    function __construct(
        UserInterface $userRepository,
        RoleInterface $roleRepository,
        UserInfoInterface $userInfoRepository
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->userInfoRepository = $userInfoRepository;
    }

    public function showLoginAdmin()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        if ($this->userRepository->count() === 0) {
            return view('user::admin.first_user');
        }

        return view('user::admin.login');
    }

    /**
     * Login admincp
     */
    public function login(LoginRequest $request)
    {
        if ($request->has('type') && $request->type === 'first_user') {

            if ($this->userRepository->count()) {
                return redirect()->route('user.admin.login')->withErrors(['loginfaild' => 'Yêu cầu không hợp lệ']);
            }

            /**
             * Create new first user
             * Create role superadmin if not exists
             * Assign user to role
             */
            try {
                $data = $request->all(['display_name', 'email', 'password']);
                $data['password'] = Hash::make($data['password']);
                $user = $this->userRepository->create($data);

                $this->userInfoRepository->create(['user_id' => $user['id']]);

                if (!$this->roleRepository->exists('superadmin')) {
                    $this->roleRepository->create([
                        'name' => 'superadmin',
                        'title' => 'Super Admin',
                        'description' => 'Quản trị toàn quyền hệ thống'
                    ]);
                }
                $user->assignRole('superadmin');
                $user->syncPermissions(null);

                return redirect()->route('user.admin.login');
            } catch (\Throwable $th) {
                $errors = [
                    'loginfaild' => 'Đã xảy ra lỗi, vui lòng thử lại'
                ];
                return redirect()->route('user.admin.login')->withInput()->withErrors($errors);
            }
        }

        $is_remember = $request->has('is_remember') ? true : false;

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password], $is_remember)) {
            if (auth()->user()->status == 0) {
                auth()->logout();
                session()->flush();
                $errors = [
                    'loginfaild' => 'Tài khoản của bạn đang bị khóa.'
                ];
            } else {
                if ($request->has('redirect_to') && !empty($request->redirect_to)) {
                    return redirect()->to(base64_decode($request->redirect_to));
                }
                return redirect()->route('dashboard');
            }
        } else {
            $errors = [
                'loginfaild' => 'Thông tin đăng nhập không chính xác.'
            ];
        }
        return redirect()->route('user.admin.login')->withInput()->withErrors($errors);
    }

    public function logout()
    {
        if (auth()->check()) {
            $old_lang = session('admin-locale');
            auth()->logout();
            session()->flush();
            session()->put('admin-locale', $old_lang);
        }
        return redirect()->route('index');
    }

    /**
     * Redirect the user to the Github authentication page
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Github
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
            $userSocial = UserSocial::where('social_id', $socialUser['id'])->where('provider', $provider)->first();
            if (auth('web')->check()) {
                if ($userSocial) {
                    $result = json_encode([
                        'status' => false,
                        'message' => 'Tài khoản MXH này đã được liên kết trên hệ thống trước đó.'
                    ]);
                    return view('User::web.callback_login_social', compact('result'));
                } else {
                    UserSocial::create([
                        'user_id' => auth('web')->id(),
                        'provider' => $provider,
                        'social_id' => $socialUser['id'],
                        'name' => $socialUser['name']
                    ]);
                    $result = json_encode([
                        'status' => true,
                        'message' => 'Liên kết tài khoản MXH thành công.'
                    ]);
                    return view('User::web.callback_login_social', compact('result'));
                }
            } else {
                if ($userSocial) {
                    $user = User::find($userSocial['user_id']);
                    auth('web')->login($user);
                    $result = json_encode([
                        'status' => true,
                        'message' => 'Đăng nhập thành công.'
                    ]);
                    return view('User::web.callback_login_social', compact('result'));
                } else {
                    $result = json_encode([
                        'status' => false,
                        'message' => 'Tài khoản MXH chưa được liên kết. Hãy đăng nhập bằng email và liên kết MXH trong phần thiết lập tài khoản.'
                    ]);
                    return view('User::web.callback_login_social', compact('result'));
                }
            }
        } catch (\Throwable $th) {
            $result = json_encode([
                'status' => false,
                'message' => 'Đã xảy ra lỗi, vui lòng thử lại.'
            ]);
            return view('User::web.callback_login_social', compact('result'));
        }
    }
}