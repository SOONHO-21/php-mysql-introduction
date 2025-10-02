create table _mem (
    num int not null auto_increment,
    id char(20) not null,
    pass char(20) not null,
    name char(20) not null,
    email char(80),
    regist_day char(20),
    level int not null default 0,  -- 0=유저, 1=관리자
    point int,
    profile_img VARCHAR(255) DEFAULT NULL, 
    primary key(num)
);

-- ALTER TABLE _mem ADD COLUMN profile_img VARCHAR(255) DEFAULT NULL;

-- INSERT INTO _mem (id, pass, name, email, regist_day, level) VALUES ('admin', 'passwd', '관리자', 'admin@test.com', NOW(), 1);