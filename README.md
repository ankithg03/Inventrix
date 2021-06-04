#README.md


## Basic Information

**Note:** copy init & appSetup.sh file to Magento folder

**COMMANDS :** 

**root user**

    sudo su 
**init shell script:**

    bash ./init

**Clone Repo**

    git clone https://github.com/ankithg03/Inventrix.git app
    
**change into app folder**

    cd app
    
**Create New Branch**

    git checkout -b feature/{name-of-your-feature/task} Development #ex: git checkout -b feature/sample-module Development
    
**Go back to Magento Directory**
  
    cd .. # or cd {magento-directory} 
    
**run appScript.sh**

    bash ./appSetup.sh

## Git Commands
1. **git init**: for creating a new repo and linking it with an empty repository.

	    git init
2. **git clone**: for using the exiting repository and working on it.

	    syntax: git clone <repo-name> <directory>
	    Example: git clone https://github.com/ankithg03/Inventrix.git app 
3. **git config**: for configuring the git info such as user name , email and all.
		

	    Example:
	    git config –global user.name “Ankith G”
	    git config –global user.email “ankithg03@gmail.com”
4. **git add**: for adding the files to git 

        syntax: git add <file>
        Example:
	    git add code/Codilar/InstagramWidget
5. **git commit**: In Simple words git commit is like a storing of code in a separate space where all the things you commit are tracked.
		
		syntax: 
		       git commit -m "Message"
		       git commit --amend -m "Change the Message"
        Example:
	    git commit -m "[feature/module-instagram] Instagram Module Added"
6. **git branch**: This command lists all the local branches in the current repository.
		
		syntax: 
		       git branch #shows list of branch present
		       git branch -D <branch-name> #deletes the branch
7. **git checkout**: This command is to switch and create the branches
		       
       syntax: 
		       git checkout <branch-name> #switch to the existing branch
		       git checkout-b <new-branch-name> #switch to new branch by creating it.
		       git checkout <file-name> #removes the modified content or file.   
		       git checkout-b <new-branch-name> <reference-branch>
		       (Switch to a new branch by keeping the reference).
       Example: 
		       git checkout -b feature/module-instagram development
Note: 
**Why do we require branch model?**

		 

> Lets assume you are writing a code, for a feature called mobile login, initially the requirement would be for mobile login for all the country. you wrote code by considering all the country code, you may have finished 80% of work, later client says we are  just releasing this phase in India so lets finish it fast only do it for India. So you have to remove 40% code and make changes, tomorrow the client says they decided to release in all the country so they require the feature, so you would have to rework and build it.

> Instead of doing this if you create a new branch(feature/mobile-login-v1.0) from the feature/mobile-login, then tomorrow you can pull from the existing and continue the work.

**Branch Model**
		       
![enter image description here](https://lh3.google.com/u/0/d/10oJPdr6RZUjhQ7b8GcODSaQduLxeZdR_=w1353-h981-iv1)
	

8. **git diff**: This command is to check the difference between the current code and previous commit.
		       
       syntax: 
		       git diff  #when you want to check diff across all the files. 
		       git diff <file-name> #when you want to check difference in a specific file
       Example: 
		       git diff
		       git diff code/Codilar/Instagram/etc/frontend/di.xml
		       
9. **git push**: This command is to push the commit to your respective branch
		       
       syntax: 
		       git push origin <branch-name> #when you have to push the origin repository
		       git push <remote-name> <new-branch-name> #when you to push to a remote repository.).
       Example: 
		       git push origin feature/mobile-login

Note: Some other important commands such as git reset, git stash, git rebase are used when we add a file to git by mistake and we want to fix it or revert it.
1. [Rebase](https://git-scm.com/docs/git-rebase/en)
2. [Stash](https://git-scm.com/docs/git-stash) 
3. [Reset](https://git-scm.com/docs/git-reset)
	  
      

