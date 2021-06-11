# Tổng quan

---

-   [Tổng quan](#t%e1%bb%95ng-quan)
    -   [Giới thiệu](#gi%e1%bb%9bi-thi%e1%bb%87u)
    -   [Môi trường phát triển](#m%c3%b4i-tr%c6%b0%e1%bb%9dng-ph%c3%a1t-tri%e1%bb%83n)
    -   [Các thay đổi mới](#các-thay-đổi-mới)

<a name="giới-thiệu"></a>
## Giới thiệu

-   Chào các Developer đến từ **Mitech Center**, xin giới thiệu đây là bộ bí kiếp thần thánh được xây dựng nhằm giúp các anh em luyện công để làm nên các project để đời cho thiên hạ trầm trồ. =]]
-   Tài liệu mô tả cấu trúc, cách xây dựng hệ thống, cũng như xây dựng một module theo đúng chuẩn phát triển PHP.

<a name="môi-trường-phát-triển"></a>
## Môi trường phát triển

-   **Hệ điều hành:** Windows, Linux, MacOS.
-   **Phần mềm:** Phiên bản Laravel đang dùng: **6.x**, có các yêu cầu bên dưới:
    -   PHP >= 7.2.0
    -   BCMath PHP Extension
    -   Ctype PHP Extension
    -   Fileinfo PHP extension
    -   JSON PHP Extension
    -   Mbstring PHP Extension
    -   OpenSSL PHP Extension
    -   PDO PHP Extension
    -   Tokenizer PHP Extension
    -   XML PHP Extension

<a name="các-thay-đổi-mới"></a>
## Các thay đổi mới

- Hợp nhất các thư mục trong **system** thành một **core** chung.
- Áp dụng các desgin pattern vào phát triển: **Repository**, **Service**
- Các khái niệm: **Interface**, **Abstract**, **Facade**, **Trait**
- Thay đổi cơ chế load module thông qua **<u>ModuleName</u>ServiceProvider** trong từng module, giúp việc khởi chạy module linh hoạt hơn.
- Tái cấu trúc lại việc tổ chức file và thư mục trong module. Xem [**Cấu trúc module**](/{{route}}/{{version}}/module/construct)
- Đổi **config** từ DB thành **setting** để tránh nhầm lẫn với config mặc định của Laravel.
- Quản lý **migrations** trong từng module, hạn chế việc phải cài lại module khi thay đổi cấu trúc bảng dữ liệu.
- Chuyển phần xử lý business logic vào trong repository, controller giao tiếp với repository thông qua interface.
- Chuyển validation vào các custom request, không validate trực tiếp trong controller nữa.
- Ứng dụng các package: **SEOHelper**,...
- **pageTitle->setTitle()**, **pageTitle->getTitle()** thông qua helper (Facade).
- Multi locale, ngôn ngữ giao diện.
