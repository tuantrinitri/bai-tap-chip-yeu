# Cấu trúc module

---

- [Cấu trúc module](#c%e1%ba%a5u-tr%c3%bac-module)
  - [Sơ lược](#s%c6%a1-l%c6%b0%e1%bb%a3c)
  - [Cấu trúc](#c%e1%ba%a5u-tr%c3%bac)

<a name="sơ-lược"></a>
## Sơ lược

- Mỗi module được phát triển độc lập, có thể cài đặt hoặc gỡ bỏ một cách linh hoạt nhất. Nếu các module có liên quan với nhau, cần kiểm tra thật kỹ trước khi tiến hành cài đặt hoặc gỡ bỏ trên hệ thống.

<a name="cấu-trúc"></a>
## Cấu trúc

- **<u>module_name</u>**: thư mục chứa các file, thư mục của module.
    - [**config**](/{{route}}/{{version}}/module/config): chứa các file config .php.
    - **helpers**: gồm các file .php chứa các function hỗ trợ cho module.
    - **includes**: các file .php thường dùng để require hoặc include, ví dụ: *breadcrumbs.php*
    - **migrations**: chứa các migration, phục vụ việc quản lý các bảng dữ liệu của module.
    - **resources**
        - **lang**: các thư mục ứng với các ngôn ngữ khác nhau, mỗi thư mục chứa các file .php cho các bản dịch.
        - **views**: chứa các view của module.
    - **routes**
        - *web.php*
    - **src**
        - **Http**
            - **Controllers**
            - **Requests**
        - **Models**
        - **Providers**
            - *<u>ModuleName</u>*ServiceProvider.php
        - **Respositories**
            - **Eloquents**
            - **Interfaces**
        - *Module.php*
    - [*info.json*](/{{route}}/{{version}}/module/info_json)
