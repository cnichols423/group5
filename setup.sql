create table users(
    username varchar(45) not null unique,
    password varchar(45) not null,
    primary key (username)
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
  coachId int not null,
  coachFname varchar(45) not null,
  coachLname varchar(45) not null,
  seasonsCoached int not null,
  primary key (coachId)
);

create table division(
  division varchar(45) not null unique ,
  primary key (division)
);

create table team(
  teamId int not null auto_increment,
  teamName varchar(45) not null,
  division varchar(45) not null,
  teamUsername varchar(45) not null,
  teamLocation varchar(45) not null,
  primary key (teamId),
  index userInd (teamUsername),
  index divisionInd(division),
  foreign key (teamUsername) references users(username),
  foreign key (division) references division(division)
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
    coachSalary int not null,
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
    usrSenderName varchar(45) not null,
    usrReceiverName varchar(45) not null,
    tradeStatus varchar(45) not null,
    playerId int not null,
    index senderInd (usrSenderName),
    index receiverInd (usrReceiverName),
    foreign key (usrReceiverName) references users(username),
    foreign key (usrSenderName) references users(username),
    primary key (tradeId)
);

insert into division (division) values ("North");
insert into division (division) values ("East");
insert into division (division) values ("South");
insert into division (division) values ("West");
