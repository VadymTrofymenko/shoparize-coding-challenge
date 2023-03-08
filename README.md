# shoparize-coding-challenge

## How to run

- Run `docker-compose up -d`

## Resources

### `/distance`:

- Method: GET
- Query Params: 
  - `first_distance_value` => `float`,
  - `first_distance_unit` => _Unit_, 
  - `second_distance_value` => `float`, 
  - `second_distance_unit` => _Unit_, 
  - `response_unit` => _Unit_


## Dictionary

- Unit: unit of distance, values - _METER_, _YARD_


## What I would like to improve

- Deal with floats: write some helpers/library for rounding and avoid mistakes
- I don't really like that there are consts from service in tests, I would like to encapsulate it
- I would like to add more strong validation of request