===source===
<?php
class C {
    public function m(int $f, void &$g) {}
}
===errors===
void cannot be used as a parameter type
===php_error===
PHP Fatal error:  void cannot be used as a parameter type in Standard input code on line 3
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
                  "params": [
                    {
                      "name": {
                        "name": "f",
                        "span": {
                          "start": 42,
                          "end": 44
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
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
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 38,
                        "end": 44
                      }
                    },
                    {
                      "name": {
                        "name": "g",
                        "span": {
                          "start": 52,
                          "end": 54
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "void"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 46,
                              "end": 50
                            }
                          }
                        },
                        "span": {
                          "start": 46,
                          "end": 50
                        }
                      },
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 46,
                        "end": 54
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
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
