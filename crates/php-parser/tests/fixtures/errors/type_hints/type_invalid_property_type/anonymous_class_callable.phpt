===source===
<?php
$i = new class {
    public callable $i;
};
===errors===
Property class@anonymous::$i cannot have type callable
===php_error===
PHP Fatal error:  Property class@anonymous::$i cannot have type callable in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "i"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
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
                                "Property": {
                                  "name": {
                                    "name": "i",
                                    "span": {
                                      "start": 43,
                                      "end": 45
                                    }
                                  },
                                  "modifiers": {
                                    "visibility": "Public"
                                  },
                                  "type_hint": {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "callable"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 34,
                                          "end": 42
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 34,
                                      "end": 42
                                    }
                                  },
                                  "default": null,
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 27,
                                "end": 45
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 48
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 48
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 48
          }
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
