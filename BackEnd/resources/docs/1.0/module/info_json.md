# info.json

---

- [info.json](#infojson)
  - [code](#code)
  - [name](#name)
  - [title](#title)
  - [description](#description)
  - [namespace](#namespace)
  - [provider](#provider)
  - [author](#author)
  - [url](#url)
  - [version](#version)

<a name="code"></a>
## code

```json
{
    "name": "<module_name>",
    "title": "Module name",
    "description": "This is description for module",
    "namespace": "Modules\\<ModuleName>\\",
    "provider": "Modules\\<ModuleName>\\Providers\\<ModuleName>ServiceProvider",
    "author": "Author Name",
    "url": "Link to Auhthor",
    "version": "1.0.0"
}
```

<a name="name"></a>
## name

- **Quy tắc:** viết thường, không dấu, không có khoảng cách.
- Đây là tên của module, tên này trùng mới thư mục chứa module.
- Nên chọn tên phù hợp, gồm 1 từ duy nhất nhưng thể hiện được nội dung của module.

```json
{
    "name": "<module_name>",
    ...
}
```

<a name="title"></a>
## title

Đây là tiêu đề ngắn gọn của module.

```json
{
    ...
    "title": "Module name",
    ...
}
```

<a name="description"></a>
## description

Đây là phần mô tả về module.

```json
{
    ...
   "description": "This is description for module",
    ...
}
```

<a name="namespace"></a>
## namespace

- Khai báo namespace của module, namespace này sẽ tương ứng với thư mục **src** trong module.

```json
{
    ...
    "namespace": "Modules\\<ModuleName>\\",
    ...
}
```

<a name="provider"></a>
## provider

- Khai báo Provider Service khởi chạy của module.

```json
{
    ...
    "provider": "Modules\\<ModuleName>\\Providers\\<ModuleName>ServiceProvider",
    ...
}
```

<a name="author"></a>
## author

- Tác giả của module.

```json
{
    ...
    "author": "Author Name",
    ...
}
```

<a name="url"></a>
## url

- Liên kết đến trang thông tin của tác giả, hoặc liên kết đến kho code của module

```json
{
    ...
    "url": "Link to Auhthor",
    ...
}
```

<a name="version"></a>
## version

- Phiên bản của module.

```json
{
    ...
    "version": "1.0.0"
}
```
