CREATE TABLE USER_TYPES
(
CODE_U VARCHAR2(255) CONSTRAINT CODE_PK PRIMARY KEY ,
COMMITTEE VARCHAR2(255) , 
DESCRIPTION VARCHAR2(255) ,
);

CREATE TABLE AGENCIES
(
CODE_A VARCHAR2(255) CONSTRAINT CODE_PK PRIMARY KEY ,
TYPE VARCHAR2(255) , 
DESCRIPTION VARCHAR2(255) ,
NAME VARCHAR2(255) ,
);

CREATE TABLE LOCATIONS
(
LOCATION_NAME VARCHAR2(255) CONSTRAINT LOCATION_NAME_PK PRIMARY KEY ,
LATITUDE VARCHAR2(255) , 
LONGITUDE VARCHAR2(255) ,
);

CREATE TABLE USERS
(
ACC_ID VARCHAR2(255) CONSTRAINT USER_ACC_ID_PK PRIMARY KEY ,
NAME VARCHAR2(255) , 
EMAIL VARCHAR2(255) ,
NID VARCHAR2(255) ,
PHONE VARCHAR2(255) ,
PASSWORD VARCHAR2(255) ,
CONSTRAINT LOCATION_NAME_FK FOREIGN 
KEY(LOCATION_NAME) REFERENCES LOCATIONS(LOCATION_NAME) ON DELETE CASCADE ,
CONSTRAINT ROLE_FK FOREIGN 
KEY(CODE_U) REFERENCES USER_TYPES(CODE_U) ON DELETE CASCADE ,
CONSTRAINT AGENCY_FK FOREIGN 
KEY(CODE_A) REFERENCES AGENCIES(CODE_A) ON DELETE CASCADE ,
);

CREATE TABLE CONSTRAINTS
(
CODE_C VARCHAR2(255) CONSTRAINT CODE_PK PRIMARY KEY ,
MAX_LIMIT VARCHAR2(255) , 
CONSTRAINT_TYPE VARCHAR2(255) ,
);

CREATE TABLE PROJECTS
(
PROJECT_ID VARCHAR2(255) CONSTRAINT PROJECT_ID_PK PRIMARY KEY ,
NAME VARCHAR2(255) , 
COST VARCHAR2(255) ,
TIMESPAN VARCHAR2(255) ,
GOAL VARCHAR2(255) ,
CONSTRAINT LOCATION_NAME_FK FOREIGN 
KEY(LOCATION_NAME) REFERENCES LOCATIONS(LOCATION_NAME) ON DELETE CASCADE ,
CONSTRAINT AGENCY_FK FOREIGN 
KEY(CODE_A) REFERENCES AGENCIES(CODE_A) ON DELETE CASCADE ,
);

CREATE TABLE COMPONENTS
(
COMPONENT_ID VARCHAR2(255) CONSTRAINT COMPONENT_ID_PK PRIMARY KEY ,
COMPONENT_TYPE VARCHAR2(255) , 
BUDGET_RATIO VARCHAR2(255) ,
STATUS VARCHAR2(255) ,
CONSTRAINT PROJECT_ID_FK FOREIGN 
KEY(PROJECT_ID) REFERENCES PROJECTS(PROJECT_ID) ON DELETE CASCADE ,
);

CREATE TABLE DEPENDS_ON
(
CONSTRAINT COMPONENT_ID1_FK FOREIGN 
KEY(COMPONENT_ID1) REFERENCES COMPONENTS(COMPONENT_ID) ON DELETE CASCADE ,
CONSTRAINT COMPONENT_ID2_FK FOREIGN 
KEY(COMPONENT_ID2) REFERENCES COMPONENTS(COMPONENT_ID) ON DELETE CASCADE ,
);

CREATE TABLE APPROVED_PROJECTS
(
ACTUAL_COST VARCHAR2(255) , 
START_DATE VARCHAR2(255) ,
COMPLETION VARCHAR2(255) ,
CONSTRAINT PROJECT_ID_FK FOREIGN 
KEY(PROJECT_ID) REFERENCES PROJECTS(PROJECT_ID) ON DELETE CASCADE ,
);

CREATE TABLE PROPOSALS
(
PROPOSAL_DATE VARCHAR2(255) , 
PROJECTED_START_DATE VARCHAR2(255) ,
PROJECTED_END_DATE VARCHAR2(255) ,
CONSTRAINT PROJECT_ID_FK FOREIGN 
KEY(PROJECT_ID) REFERENCES PROJECTS(PROJECT_ID) ON DELETE CASCADE ,
);

CREATE TABLE FEEDBACKS
(
CONSTRAINT ACC_ID_FK FOREIGN 
KEY(ACC_ID) REFERENCES USERS(ACC_ID) ON DELETE CASCADE ,
CONSTRAINT PROJECT_ID_FK FOREIGN 
KEY(PROJECT_ID) REFERENCES PROJECTS(PROJECT_ID) ON DELETE CASCADE ,
DESCRIPTION VARCHAR2(255) ,
);

CREATE TABLE RATINGS
(
CONSTRAINT ACC_ID_FK FOREIGN 
KEY(ACC_ID) REFERENCES USERS(ACC_ID) ON DELETE CASCADE ,
CONSTRAINT PROJECT_ID_FK FOREIGN 
KEY(PROJECT_ID) REFERENCES PROJECTS(PROJECT_ID) ON DELETE CASCADE ,
RATING_POINTS VARCHAR2(255) ,
);