===source===
<?php
namespace N;
class K {
    public function g(): K|self {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
===errors >=8.5===
Duplicate type N\K is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 4
===php_error >=8.5===
PHP Fatal error:  Duplicate type N\K is redundant in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "K",
            "span": {
              "start": 25,
              "end": 26
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
                    "name": "g",
                    "span": {
                      "start": 49,
                      "end": 50
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
                                "K"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 54,
                                "end": 55
                              }
                            }
                          },
                          "span": {
                            "start": 54,
                            "end": 55
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 56,
                                "end": 60
                              }
                            }
                          },
                          "span": {
                            "start": 56,
                            "end": 60
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 54,
                      "end": 60
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 63
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 65
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65
  }
}
