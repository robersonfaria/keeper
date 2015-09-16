# InputKeeper
Uma abstração do Laravel Session para guardar valores de inputs (pages, filters, etc)

# Registrar o ServiceProvider (app.php)

'Jakjr\Keeper\KeeperServiceProvider',

# Uso no Controller
```
class KeepController extends BaseController {

    private $keeper;

    function __construct()
    {
        $this->keeper = App::make('keeper', [$this]);
    }

    public function index()
    {
        return View::make('keep.index')
            ->with('keeper', $this->keeper);
    }

    public function keep()
    {
        $this->keeper->keep(Input::only(['name', 'page']));
        return Redirect::back();
    }
}
```

# Uso na View
```
{{Form::open(['action'=>'KeepController@keep'])}}

    {{Form::text('name', $keeper->get('name'))}}

    {{Form::text('page', $keeper->get('page'))}}

    {{Form::text('teste', $keeper->get('teste'))}}

    {{Form::submit()}}

{{Form::close()}}
```