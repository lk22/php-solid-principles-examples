<?php 



        // DIP Dependency Inversion Principle a violation example
        public function index() {
            $users = new User();
            $users = $users->where('created_at', Carbon::yesterday());

            return respons()->json(['users', $users]);
        } 

        // DIP Dependency Inversion Principle a solution example
        interface UserRepositoryInterface {
            public function getUserFromYesterday(DateInterface $date): array;
        }

        class UserEloquentRepository implements UserRepositoryInterface {
            public function getUserFromYesterday(DateInterface $date): array {
                return User::where('created_at', '>', $date)
                    ->get()
                    ->toArray();
            }
        }

        class UserSqlRepository implements UserRepositoryInterface {
            public function getUserFromYesterday(DateInterface $date): array {
                return DB::table('users')
                    ->where('created_at', '>', $date)
                    ->get()
                    ->toArray();
            }
        }

        class UserCsvRepository implements UserRepositoryInterface {
            public function getUserFromYesterday(DateInterface $date): array {
                // get data from csv file
                $filename = "users_created_{$date}.csv";
                $file = fopen($filename, "r");

                while (($users[] = fgetcsv($file, 1000, ",")) !== false) {
                    $users[] = $data;
                }

                fclose($file);

                return $users;
            }
        }

        // namespace App\Provideres
        // use Illuminate\Support\ServiceProvider;

        class AppServiceProvider extends ServiceProvider {
            public function register() {
                $this->app->bind(UserRepositoryInterface::class, UserEloquentRepository::class);
            }
        }

?>