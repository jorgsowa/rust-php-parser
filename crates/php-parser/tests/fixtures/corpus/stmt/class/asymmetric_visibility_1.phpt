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
===errors <=7.4===
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$a must have type
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$b must have type
Visibility of property must not be weaker than set visibility
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$c must have type
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$d must have type
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
Visibility of property must not be weaker than set visibility
Property with asymmetric visibility Test::$e must have type
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$f must have type
'trailing comma in parameter list' requires PHP 8.0 or higher
===errors 8.0-8.3===
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$a must have type
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$b must have type
Visibility of property must not be weaker than set visibility
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$c must have type
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$d must have type
'asymmetric visibility' requires PHP 8.4 or higher
Visibility of property must not be weaker than set visibility
Property with asymmetric visibility Test::$e must have type
'asymmetric visibility' requires PHP 8.4 or higher
Property with asymmetric visibility Test::$f must have type
===errors >=8.4===
Property with asymmetric visibility Test::$a must have type
Property with asymmetric visibility Test::$b must have type
Visibility of property must not be weaker than set visibility
Property with asymmetric visibility Test::$c must have type
Property with asymmetric visibility Test::$d must have type
Visibility of property must not be weaker than set visibility
Property with asymmetric visibility Test::$e must have type
Property with asymmetric visibility Test::$f must have type
===php_error <=8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 4
===php_error >=8.4===
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
                  "modifiers": {
                    "visibility": "Protected",
                    "set_visibility": "Private"
                  },
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
                  "modifiers": {
                    "visibility": "Private",
                    "set_visibility": "Public"
                  },
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
                  "modifiers": {
                    "set_visibility": "Protected"
                  },
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
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                      "modifiers": {
                        "visibility": "Protected",
                        "set_visibility": "Private"
                      },
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
                      "modifiers": {
                        "visibility": "Private",
                        "set_visibility": "Public"
                      },
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
                      "modifiers": {
                        "set_visibility": "Protected"
                      },
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
