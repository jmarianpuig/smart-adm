<div>
    <div
    class="flex flex-col px-6 py-10 overflow-hidden bg-white hover:bg-gradient-to-br hover:from-purple-400 hover:via-blue-400 hover:to-blue-500 rounded-xl shadow-lg duration-300 hover:shadow-2xl group">
    {!! $usersByAge->container() !!}
    <script src="{{ $usersByAge->cdn() }}"></script>
    {{ $usersByAge->script() }}
    </div>
</div>
