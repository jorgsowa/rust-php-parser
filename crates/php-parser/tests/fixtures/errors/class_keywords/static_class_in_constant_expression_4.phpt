===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { #[Attr(static::class)] function f() {} }
===errors <=7.4===
missing closing '}'
===errors >=8.0===
static::class cannot be used for compile-time class name resolution
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 1
===php_error >=8.0===
PHP Fatal error:  static::class cannot be used for compile-time class name resolution in Standard input code on line 1
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
                    "name": "f",
                    "span": {
                      "start": 48,
                      "end": 49
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attr"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 18,
                          "end": 22
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "ClassConstAccess": {
                                  "class": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "static"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 23,
                                          "end": 29
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 23,
                                      "end": 29
                                    }
                                  },
                                  "member": {
                                    "kind": {
                                      "Identifier": "class"
                                    },
                                    "span": {
                                      "start": 31,
                                      "end": 36
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 23,
                                "end": 36
                              }
                            }
                          },
                          "span": {
                            "start": 23,
                            "end": 36
                          }
                        }
                      ],
                      "span": {
                        "start": 18,
                        "end": 37
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
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
