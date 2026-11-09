===source===
<?php
trait T {
    public function l(): SELF&A {}
}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
Type SELF cannot be part of an intersection type
===errors >=8.1===
Type SELF cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&', expecting ';' or '{' in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "&", expecting ";" or "{" in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Type SELF cannot be part of an intersection type in Standard input code on line 3
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
                    "name": "l",
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
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 41,
                                "end": 45
                              }
                            }
                          },
                          "span": {
                            "start": 41,
                            "end": 45
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 46,
                                "end": 47
                              }
                            }
                          },
                          "span": {
                            "start": 46,
                            "end": 47
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 41,
                      "end": 47
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 50
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
