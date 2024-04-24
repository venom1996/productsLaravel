<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Продукты') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Фото</th>
                            <th>Цена</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{$item['id']}}</td>
                            <td>{{$item['name']}}</td>
                            <td>{{$item['description']}}</td>
                            <td><img class="img-thumbnail" src="{{$item['path_photo']}}"></td>
                            <td>{{$item['price']}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>


                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Добавить товар
                    </button>


                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Добавление товара</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                </div>

                                <div class="modal-body">
                                    <form id="modal" enctype="multipart/form-data">

                                        <label for="exampleFormControlInput1" class="form-label">Название</label>
                                        <input type="text" class="form-control" name="name" id="name">
                                        <label for="exampleFormControlInput1" class="form-label">Описание</label>
                                        <input type="text" class="form-control" name="description" id="description">
                                        <label for="exampleFormControlInput1" class="form-label">Цена</label>
                                        <input type="text" class="form-control" name="price" id="price">
                                        <label class="form-label" for="customFile">Фото</label>
                                        <input type="file" class="form-control" name="photo" id="photo">

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="save">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
