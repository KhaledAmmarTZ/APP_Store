<form class="form-inline my-2 my-lg-0 ml-3" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block" style="background: none; border: none; padding: 0;">
                            <i class="fa-solid fa-arrow-right-from-bracket" style="color: white; font-size: 20px;"></i>
                        </button>
                    </form>