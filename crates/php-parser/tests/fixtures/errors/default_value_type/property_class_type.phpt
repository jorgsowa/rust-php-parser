===source===
<?php
namespace N;
class A {
    public ?Foo $x = 1;
}
===errors <=7.4===
Property of type N\Foo may not have default value
===errors >=8.0===
Cannot use int as default value for property N\A::$x of type ?N\Foo
===php_error <=7.4===
PHP Fatal error:  Property of type N\Foo may not have default value in Standard input code on line 4
===php_error >=8.0===
PHP Fatal error:  Cannot use int as default value for property N\A::$x of type ?N\Foo in Standard input code on line 4
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
            "name": "A",
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
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 45,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Foo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 41,
                              "end": 44
                            }
                          }
                        },
                        "span": {
                          "start": 41,
                          "end": 44
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 44
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 50,
                      "end": 51
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 51
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
