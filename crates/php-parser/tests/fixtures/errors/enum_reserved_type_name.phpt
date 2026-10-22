===source===
<?php
enum Mixed {}
enum int {}
enum Iterable {}
enum Never {}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Cannot use "Mixed" as an enum name as it is reserved
'enums' requires PHP 8.1 or higher
Cannot use "int" as an enum name as it is reserved
'enums' requires PHP 8.1 or higher
Cannot use "Iterable" as an enum name as it is reserved
'enums' requires PHP 8.1 or higher
===errors >=8.1===
Cannot use "Mixed" as an enum name as it is reserved
Cannot use "int" as an enum name as it is reserved
Cannot use "Iterable" as an enum name as it is reserved
Cannot use "Never" as an enum name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Mixed' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Mixed" in Standard input code on line 2
===php_error 8.1-8.3===
PHP Fatal error:  Cannot use 'Mixed' as class name as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "Mixed" as an enum name as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Mixed",
            "span": {
              "start": 11,
              "end": 16
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "int",
            "span": {
              "start": 25,
              "end": 28
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 20,
        "end": 31
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Iterable",
            "span": {
              "start": 37,
              "end": 45
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 32,
        "end": 48
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Never",
            "span": {
              "start": 54,
              "end": 59
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 49,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
