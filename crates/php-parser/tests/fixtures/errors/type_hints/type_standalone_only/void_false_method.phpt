===source===
<?php
class C {
    public function m(): void|false {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'false type' requires PHP 8.0 or higher
Void can only be used as a standalone type
===errors >=8.0===
Void can only be used as a standalone type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Void can only be used as a standalone type in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "void"
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
                                "false"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 46,
                                "end": 51
                              }
                            }
                          },
                          "span": {
                            "start": 46,
                            "end": 51
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 41,
                      "end": 51
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 54
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
