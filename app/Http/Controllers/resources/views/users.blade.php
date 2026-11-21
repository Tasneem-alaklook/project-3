
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المستخدمين</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4 text-center">إدارة المستخدمين</h2>

    <!-- نموذج الإضافة والتعديل -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">

            @if(isset($user))

                <h5 class="mb-3">تعديل المستخدم</h5>

                <form action="{{ url('/users/update/' . $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">اسم المستخدم</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ $user->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ $user->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">كلمة المرور الجديدة (اختياري)</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">
                        تحديث المستخدم
                    </button>

                    <a href="{{ url('/users') }}" class="btn btn-secondary">
                        إلغاء
                    </a>
                </form>

            @else

                <h5 class="mb-3">إضافة مستخدم جديد</h5>

                <form action="{{ url('/users') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">اسم المستخدم</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        إضافة المستخدم
                    </button>
                </form>

            @endif

        </div>
    </div>

    <!-- جدول عرض المستخدمين -->
    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-striped text-center">

                <thead>
                    <tr>
                        <th>رقم المستخدم</th>
                        <th>اسم المستخدم</th>
                        <th>البريد الإلكتروني</th>
                        <th>العمليات</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>

                            <td>
                                <a href="{{ url('/users/edit/' . $u->id) }}"
                                   class="btn btn-primary btn-sm">
                                    تعديل
                                </a>

                                <form action="{{ url('/users/delete/' . $u->id) }}"
                                      method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>
