namespace App\Http\Livewire\Modals;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CreateUser extends Component
{
    public $name, $email, $password, $is_admin;
    public $showModal = false; // Controls modal visibility

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'is_admin' => 'required|boolean',
    ];

    public function openModal()
    {
        $this->reset(); // Reset form fields
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function createUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_admin' => $this->is_admin,
        ]);

        $this->emit('userCreated'); // Notify parent component
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.create-user');
    }
}
