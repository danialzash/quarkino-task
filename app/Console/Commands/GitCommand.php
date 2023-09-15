<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GitCommand extends Command
{
    const BRANCH = 'branch';
    const COMMIT = 'commit';

    // List of commit types. Add more if needed.
    const COMMIT_TYPES = [
        "fix",
        "feat",
        "docs",
        "build",
        "perf",
        "refactor",
        "style",
        "test",
        "tempt"
    ];

    // List of commit modules. Add more if needed.
    const COMMIT_MODULES = [
        "app",
        "artisan_command",
        "attachment",
        "banner",
        "base",
        "category",
        "comment",
        "content-meta",
        "convert-wp_data",
        "currency-content",
        "editor-module",
        "formable",
        "form-contact-us",
        "form-hiring",
        "language",
        "logging-pro",
        "log-hub",
        "menu",
        "notification",
        "option",
        "pages",
        "permission",
        "post",
        "slider",
        "support-solution",
        "user"
    ];

    // List of commit scopes. Add more if needed.
    const COMMIT_SCOPES = [
        "core",
        "release",
        "forms",
        "router",
        "http",
        "common",
        "interface",
        "language",
        "compiler",
        "upgrade"
    ];

    // List of branch types. Add more if needed.
    const BRANCH_TYPES = [
        'feature',
        'release',
        'hotfix',
        'support',
        ''
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:git {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute Git commands with a predetermined style';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $type = $this->argument('type');
        if (!$type || !($type == self::COMMIT || $type == self::BRANCH)) {
            $type = $this->choice("What kinds of git command do you want?", [self::BRANCH, self::COMMIT]);
        }
        $finalCommand = $this->{($type == self::COMMIT) ? 'gitCommit' : 'gitBranch'}();


        if ($this->confirm("Are you sure to run this: $finalCommand")) {
            shell_exec($finalCommand);
        } else {
            $this->alert("You have canceled the execution");
            $this->warn($finalCommand);
        }
        return 0;
    }


    /**
     * @return string
     */
    public function gitCommit(): string
    {
        $type = $this->choice("enter type of your commit ", self::COMMIT_TYPES);
        $module = $this->choice("enter the module ", self::COMMIT_MODULES);
        $scope = $this->choice("enter the scope ", self::COMMIT_SCOPES);
        $subject = $this->ask("enter the subject of your commit ");

        if ($this->confirm("Do you want to add body part?")) {
            $body = $this->ask("enter body of your commit ");
            $footer = $this->ask("Enter footer of your commit message ");
            return "git commit -m \"$type-$module($scope):$subject\n\n$body\n\n$footer\"";
        } else {
            return "git commit -m \"$type-$module($scope):$subject\"";
        }

    }

    /**
     * @return string
     */
    public function gitBranch(): string
    {
        $finalCommand = "git checkout -b ";
        $branchType = $this->choice("What is the type of branch: ", self::BRANCH_TYPES);
        $branchType && $finalCommand .= $branchType;
        $branchDescription = $this->ask("Enter the main part: ");

        return "$finalCommand/$branchDescription";
    }

}
