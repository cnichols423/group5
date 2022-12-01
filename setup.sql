create table users(
    userId int not null auto_increment,
    username int not null unique,
    password int not null,
    primary key (userId)
);

create table player(
  playerId int not null auto_increment,
  playerFname varchar(45) not null,
  playerLname varchar(45) not null,
  playerSalary int not null,
  playerSeasonsPlayed int not null,
  primary key (playerId)
);

create table coach(
  coachId int not null auto_increment,
  coachFname varchar(45) not null,
  coachLname varchar(45) not null,
  coachSalary int not null,
  seasonsCoached int not null,
  primary key (coachId)
);

create table division(
  divisionId int not null auto_increment,
  divisionName varchar(45),
  primary key (divisionId)
);

create table team(
  teamId int not null auto_increment,
  divisionId int not null,
  teamUserId int not null,
  teamCoachId int not null,
  teamLocation varchar(45) not null,
  primary key (teamId),
  index userInd (teamUserId),
  index teamCoachInd(teamCoachId),
  index divisionInd(divisionId),
  foreign key (teamUserId) references users(userId),
  foreign key (teamCoachId) references coach(coachId),
  foreign key (divisionId) references division(divisionId)
);

create table playerTeam(
    playerTeamRelId int not null auto_increment,
    playerId int not null,
    currTeamId int not null,
    prevTeamId int,
    primary key (playerTeamRelId),
    index currTeamInd (currTeamId),
    index prevTeamInd (prevTeamId),
    index playerInd (playerId),
    foreign key (currTeamId) references team(teamId),
    foreign key (prevTeamId) references  team(teamId),
    foreign key (playerId) references player(playerId)
);

create table coachTeam(
    coachTeamRelId int not null auto_increment,
    coachId int not null,
    teamId int not null,
    primary key (coachTeamRelId),
    index coachInd (coachId),
    index teamInd (teamId),
    foreign key (coachId) references coach(coachId),
    foreign key (teamId) references team(teamId)
);

create table playerInfo(
  playerInfoId int not null auto_increment,
  playerId int not null,
  playerNumber int not null,
  playerPosition varchar(45),
  primary key (playerInfoId),
  index playerInfoInd (playerId),
  foreign key (playerId) references player(playerId)
);

create table trades(
    tradeId int not null auto_increment,
    usrSenderId int not null,
    usrReceiverId int not null,
    playerId int not null,
    index senderInd (usrSenderId),
    index receiverInd (usrReceiverId),
    foreign key (usrReceiverId) references users(userId),
    foreign key (usrSenderId) references users(userId),
    primary key (tradeId)
);
