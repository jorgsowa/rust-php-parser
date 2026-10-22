===source===
<?php class Foo { public function __construct(public int $flags = FLAG_A | FLAG_B) {} }
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                      "start": 34,
                      "end": 45
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "flags",
                        "span": {
                          "start": 57,
                          "end": 63
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
                              "start": 53,
                              "end": 56
                            }
                          }
                        },
                        "span": {
                          "start": 53,
                          "end": 56
                        }
                      },
                      "default": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "FLAG_A"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 66,
                                    "end": 72
                                  }
                                }
                              },
                              "span": {
                                "start": 66,
                                "end": 72
                              }
                            },
                            "op": "BitwiseOr",
                            "right": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "FLAG_B"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 75,
                                    "end": 81
                                  }
                                }
                              },
                              "span": {
                                "start": 75,
                                "end": 81
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 66,
                          "end": 81
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 46,
                        "end": 81
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 85
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 87
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 87
  }
}
