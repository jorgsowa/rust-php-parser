===source===
<?php
trait T {
    public function m(): A&parent {}
}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
Type parent cannot be part of an intersection type
===errors >=8.1===
Type parent cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&', expecting ';' or '{' in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "&", expecting ";" or "{" in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Type parent cannot be part of an intersection type in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Intersection": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 41,
                                "end": 42
                              }
                            }
                          },
                          "span": {
                            "start": 41,
                            "end": 42
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 43,
                                "end": 49
                              }
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 49
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 41,
                      "end": 49
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 52
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
