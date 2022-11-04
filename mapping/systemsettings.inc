ACCOUNT TYPE
SYSTEM_ADMIN = overall admin
CANDIDACY_ADMIN = admin on candidacy (filing, inventory, evaulation, approval)
CANVASSING_ADMIN = canvassing admin
REGSTUD_USER = usertype of normal student/user


// DEFAULT ACCESS

SYSTEM_ADMIN
- All access. 1st person POV

CANDIDACY_ADMIN
- Dashboard
- Candidacy
	- Filing
	- Evaluation
	- Approval
	- Inventory
- myVote
- Canvassing/Partial Result
- Help

CANVASSING_ADMIN
- Dashboard
- myVote
- Canvassing/
	- Canvassing Request
	- Partial Result
	- Final
- Help

REGSTUD_USER
- Dashboard
- Candidacy
	- Filing
- myVote
- Canvassing/Partial Result
- Help



// SYSTEM SUEDO

- DASHBOARD
- ANNOUNCEMENT
- CANDIDACY
	- FILING
	- EVALUATION
	- APPROVAL
	- INVENTORY
- CONFIGURATION
	- CANDIDACY SETUP
	- INSITUTION SETUP
- DATA DESIGN
	- PERSON
	- ORGANIZATION
	- OFFICER
	- MASTERLIST
	- SETUP LOGIN
- PROCESS
	- PROCESS
	- SCHEDULE
- MYVOTE
- CANVASSING/
	- CANVASSING REQUEST (N/A)
	- PARTIAL RESULT
	- FINAL RESULT (N/A)
	- VOTING RESULT (N/A)
	- SUMMARY REPORT (N/A)
- SYSTEM ACTION
	- ACCESS CONTROL


