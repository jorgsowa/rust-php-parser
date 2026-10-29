===source===
<?php
trait int {}
trait Mixed {}
trait never {}
trait iterable {}
===errors <=7.4===
Cannot use 'int' as class name as it is reserved
Cannot use 'iterable' as class name as it is reserved
===errors 8.0===
Cannot use 'int' as class name as it is reserved
Cannot use 'Mixed' as class name as it is reserved
Cannot use 'iterable' as class name as it is reserved
===errors 8.1-8.3===
Cannot use 'int' as class name as it is reserved
Cannot use 'Mixed' as class name as it is reserved
Cannot use 'never' as class name as it is reserved
Cannot use 'iterable' as class name as it is reserved
===errors >=8.4===
Cannot use "int" as a trait name as it is reserved
Cannot use "Mixed" as a trait name as it is reserved
Cannot use "never" as a trait name as it is reserved
Cannot use "iterable" as a trait name as it is reserved
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
