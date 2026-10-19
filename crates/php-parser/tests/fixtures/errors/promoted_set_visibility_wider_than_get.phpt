===config===
min_php=8.4
===source===
<?php
class C {
    public function __construct(private protected(set) string $a, protected(set) string $b) {}
}
===errors===
Visibility of property must not be weaker than set visibility
===php_error===
PHP Fatal error:  Visibility of property C::$a must not be weaker than set visibility in Standard input code on line 3
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
                    "name": "__construct",
                    "span": {
                      "start": 36,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 78,
                          "end": 80
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 71,
                              "end": 77
                            }
                          }
                        },
                        "span": {
                          "start": 71,
                          "end": 77
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private",
                        "set_visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 48,
                        "end": 80
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 104,
                          "end": 106
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 97,
                              "end": 103
                            }
                          }
                        },
                        "span": {
                          "start": 97,
                          "end": 103
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "set_visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 82,
                        "end": 106
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
                "end": 110
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 112
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 112
  }
}
