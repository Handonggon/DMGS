create table audience (
  id int not null auto_increment,
  number int not null unique,
  name varchar(10) not null,
  participation int not null,
  division int not null,
  temper varchar(50) not null,
  phone varchar(11) not null,
  destination varchar(50) not null,
  input_date datetime not null DEFAULT CURRENT_TIMESTAMP,
  start_date datetime,
  end_date datetime,
  primary key(id)
);
