===source===
<?php
class A { function f(): int { return; } }
===errors <=8.3===
A function with return type must return a value
===errors >=8.4===
A method with return type must return a value
===php_error <=8.3===
PHP Fatal error:  A function with return type must return a value in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  A method with return type must return a value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 25,
                      "end": 26
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 30,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 33
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": null
                      },
                      "span": {
                        "start": 36,
                        "end": 43
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
