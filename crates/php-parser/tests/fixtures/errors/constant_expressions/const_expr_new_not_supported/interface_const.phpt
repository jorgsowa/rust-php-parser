===source===
<?php
interface I {
    const A = new Foo;
}
===errors===
New expressions are not supported in this context
===php_error <=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  New expressions are not supported in this context in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 38,
                                "end": 41
                              }
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 41
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 41
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 42
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
