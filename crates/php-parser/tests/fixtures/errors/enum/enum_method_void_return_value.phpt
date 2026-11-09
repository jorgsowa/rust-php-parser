===source===
<?php
enum E {
    public function f(): void { return 1; }
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
A void method must not return a value
===errors >=8.1===
A void method must not return a value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1-8.3===
PHP Fatal error:  A void function must not return a value in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  A void method must not return a value in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 40,
                          "end": 44
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 44
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 54,
                            "end": 55
                          }
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 56
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 58
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
