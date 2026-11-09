===source===
<?php
function c(): bool|true {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'true type' requires PHP 8.2 or higher
Duplicate type true is redundant
===errors 8.0-8.1===
'true type' requires PHP 8.2 or higher
Duplicate type true is redundant
===errors >=8.2===
Duplicate type true is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error 8.0-8.1===
PHP Fatal error:  Cannot use 'true' as class name as it is reserved in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Duplicate type true is redundant in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "bool"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 24
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 24
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "true"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 25,
                        "end": 29
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 29
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 29
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
