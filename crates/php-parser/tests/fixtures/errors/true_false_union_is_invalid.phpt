===source===
<?php function f(): true|false {}
===errors <=7.4===
'true type' requires PHP 8.2 or higher
'union types' requires PHP 8.0 or higher
'false type' requires PHP 8.0 or higher
Type contains both true and false, bool should be used instead
===errors 8.0-8.1===
'true type' requires PHP 8.2 or higher
Type contains both true and false, bool should be used instead
===errors 8.2-8.3===
Type contains both true and false, bool should be used instead
===errors >=8.4===
Type contains both true and false, bool must be used instead
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 1
===php_error 8.0-8.1===
PHP Fatal error:  Cannot use 'true' as class name as it is reserved in Standard input code on line 1
===php_error 8.2-8.3===
PHP Fatal error:  Type contains both true and false, bool should be used instead in Standard input code on line 1
===php_error >=8.4===
PHP Fatal error:  Type contains both true and false, bool must be used instead in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
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
                        "true"
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
                        "false"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 25,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 30
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 30
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
