# Working draft · FilmTools REST API

**Evaluating developed film densities**

## Installation

```bash
$ git clone https://github.com/filmtools/api
$ cd api
$ composer install
```

# API Outlines

**This chapter outlines the basic functionality of the RESTful FilmTools API. Please note, they're not fully (if even) implemented right now.**



## Single developings

### `POST /developings`

Creates a new developing instance on the server, and returns a Location header to the resource created.

**Request body:**

```
{
  film:          string,
  developer:     string,
  exposureIndex: int,
  time:          int,
  zones:         float[],
  densities:     float[]
}
```

**Response:**

```
201 Created
Location: /developings/42
```



### `GET /developings/:id`

Returns the JSON representation of the given developing, including all calculated developing parameters.

**Response body:**

```
{
  film:          string,
  developer:     string,
  exposureIndex: int,  
  time:          int,
  processing:    string,
  N:             float,
  zones:         float[],
  densities:     float[],
  offset:        float,
  gamma:         float
}
```

## Test suites with multiple developings

### `POST /testsuites`

Creates a new test suite on the server, and returns a Location header to the resource created.

**Request body:**

```
{
  film:      string,
  developer: string,
  
  developings: [
    {
      exposureIndex: int,
      time:          int,
      zones:         float[],
      densities:     float[]
    },
    {
      exposureIndex: 400,
      time:          600,
      zones:         [ 0, 1, 2, ... ],
      densities:     [ 0.00, 0.10, 0.17, ... ]
    },
    ...
  ]
}
```

**Response:**

```
201 Created
Location: /testsuites/42
```

### `GET /testsuites/:id`

**Response body:**

```
{
  developer:   string,
  film:        string,
  developings: developing[],
  normalTime:  int
}
```

### `GET /testsuites/:id/developings`

Returns an array with all JSON representations of the developings belonging to this testsuite.

**Response body:**

```
[
  {
    exposureIndex: int,
    time:          int,
    zones:         float[],
    densities:     float[],
    processing:    string,
    N:             float,
    gamma:         float,    
    offset:        float,
  },
  {
    exposureIndex: 400,
    time:          800,
    zones:         [ 0, 1, 2, ... ],
    densities:     [ 0.00, 0.10, 0.17, ... ],
    processing:    "push",
    N:             1.41,
    gamma:         0.55,    
    offset:        -0.25
  },
  ... 
]
```


## Unit testing

```bash
$ vendor/bin/phpunit
```



