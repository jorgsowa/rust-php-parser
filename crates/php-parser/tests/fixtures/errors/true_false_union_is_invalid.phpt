===source===
<?php function f(): true|false {}
===errors >=8.2===
Type contains both true and false, bool must be used instead
===php_error <=8.1===
PHP Fatal error:  Cannot use 'true' as class name as it is reserved in Standard input code on line 1
===php_error 8.2-8.3===
PHP Fatal error:  Type contains both true and false, bool should be used instead in Standard input code on line 1
===php_error >=8.4===
PHP Fatal error:  Type contains both true and false, bool must be used instead in Standard input code on line 1
===ast >=8.2===
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
