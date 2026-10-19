===config===
min_php=8.4
===source===
<?php

class Test {
    protected private(set) $a;
    private public(set) $b;
    protected(set) $c;

    public function __construct(
        protected private(set) $d,
        private public(set) $e,
        protected(set) $f,
    ) {}
}
===errors===
Property with asymmetric visibility Test::$a must have type
Property with asymmetric visibility Test::$b must have type
Visibility of property must not be weaker than set visibility
Property with asymmetric visibility Test::$c must have type
Property with asymmetric visibility Test::$d must have type
Visibility of property must not be weaker than set visibility
Property with asymmetric visibility Test::$e must have type
Property with asymmetric visibility Test::$f must have type
===php_error===
PHP Fatal error:  Property with asymmetric visibility Test::$a must have type in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 13,
              "end": 17
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
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 47,
                      "end": 49
                    }
                  },
                  "visibility": "Protected",
                  "set_visibility": "Private",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 49
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 75,
                      "end": 77
                    }
                  },
                  "visibility": "Private",
                  "set_visibility": "Public",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 55,
                "end": 77
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 98,
                      "end": 100
                    }
                  },
                  "visibility": null,
                  "set_visibility": "Protected",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 83,
                "end": 100
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 123,
                      "end": 134
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "d",
                        "span": {
                          "start": 167,
                          "end": 169
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Protected",
                      "set_visibility": "Private",
                      "attributes": [],
                      "span": {
                        "start": 144,
                        "end": 169
                      }
                    },
                    {
                      "name": {
                        "name": "e",
                        "span": {
                          "start": 199,
                          "end": 201
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Private",
                      "set_visibility": "Public",
                      "attributes": [],
                      "span": {
                        "start": 179,
                        "end": 201
                      }
                    },
                    {
                      "name": {
                        "name": "f",
                        "span": {
                          "start": 226,
                          "end": 228
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": "Protected",
                      "attributes": [],
                      "span": {
                        "start": 211,
                        "end": 228
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 107,
                "end": 238
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 240
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 240
  }
}
