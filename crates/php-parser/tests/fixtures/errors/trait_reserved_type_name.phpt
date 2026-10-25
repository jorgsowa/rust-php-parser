===source===
<?php
trait int {}
trait Mixed {}
trait never {}
trait iterable {}
===errors <=7.4===
cannot use 'int' as trait name
cannot use 'iterable' as trait name
===errors 8.0===
cannot use 'int' as trait name
cannot use 'Mixed' as trait name
cannot use 'iterable' as trait name
===errors >=8.1===
cannot use 'int' as trait name
cannot use 'Mixed' as trait name
cannot use 'never' as trait name
cannot use 'iterable' as trait name
===php_error <=8.3===
PHP Fatal error:  Cannot use 'int' as class name as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "int" as a trait name as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "int",
            "span": {
              "start": 12,
              "end": 15
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "Mixed",
            "span": {
              "start": 25,
              "end": 30
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 33
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "never",
            "span": {
              "start": 40,
              "end": 45
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 34,
        "end": 48
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "iterable",
            "span": {
              "start": 55,
              "end": 63
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 49,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
