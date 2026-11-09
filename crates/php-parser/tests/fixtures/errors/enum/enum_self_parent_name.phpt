===source===
<?php
enum Self {}
enum parent {}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Cannot use "Self" as an enum name as it is reserved
'enums' requires PHP 8.1 or higher
Cannot use "parent" as an enum name as it is reserved
===errors >=8.1===
Cannot use "Self" as an enum name as it is reserved
Cannot use "parent" as an enum name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Self' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Self" in Standard input code on line 2
===php_error 8.1-8.3===
PHP Fatal error:  Cannot use 'Self' as class name as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "Self" as an enum name as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Self",
            "span": {
              "start": 11,
              "end": 15
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
        "end": 18
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "parent",
            "span": {
              "start": 24,
              "end": 30
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
