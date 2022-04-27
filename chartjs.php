select * from sales
     where order_date > now() - INTERVAL 7 day;


select * from sales
    where order_date > now() - interval 1 week;