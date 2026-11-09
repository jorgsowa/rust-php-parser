===source===
<?php
function a(): Foo|FOO {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Duplicate type FOO is redundant
===errors >=8.0===
Duplicate type FOO is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Duplicate type FOO is redundant in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
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
                        "Foo"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 23
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "FOO"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 27
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 27
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 27
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
