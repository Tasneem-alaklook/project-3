<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المهام</title>
    <!-- استيراد تصميم Bootstrap لتنسيق الصفحة والجدول -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4 text-center">قائمة المهام</h2>

        <!-- نموذج التعديل أو الإضافة -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                @isset($task)
                    <!-- نموذج التعديل (Update) -->
                    <form action="{{ url('/update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $task->id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">تعديل المهمة</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">تحديث المهمة</button>
                        <a href="{{ url('/tasks') }}" class="btn btn-secondary">إلغاء</a>
                    </form>
                @endisset
            </div>
        </div>

        <!-- جدول عرض المهام -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>رقم المهمة</th>
                            <th>اسم المهمة</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $t)
                            <tr>
                                <td>{{ $t->id }}</td>
                                <td>{{ $t->name }}</td>
                                <td>
                                    <!-- زر الانتقال لتعديل المهمة -->
                                    <form action="{{ url('/edit/' . $t->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">تعديل</button>
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
