===description===
A promoted constructor property redeclares a property of the same name (case-sensitive) declared before or after the constructor.
===source===
<?php
class A {
    public $a;
    public $B;
    public function __construct(public $a, private $b, public readonly int $c) {}
    public $c;
}
trait T {
    public function __construct(protected $x, protected $x) {}
    public $x;
}
===errors===
Cannot redeclare A::$a
Cannot redeclare A::$c
Redefinition of parameter $x
Cannot redeclare T::$x
===php_error===
PHP Fatal error:  Cannot redeclare A::$a in Standard input code on line 5
===ast===
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
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 29
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 42,
                      "end": 44
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 35,
                "end": 44
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 66,
                      "end": 77
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
                          "start": 85,
                          "end": 87
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 78,
                        "end": 87
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 97,
                          "end": 99
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private"
                      },
                      "attributes": [],
                      "span": {
                        "start": 89,
                        "end": 99
                      }
                    },
                    {
                      "name": {
                        "name": "c",
                        "span": {
                          "start": 121,
                          "end": 123
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
                              "start": 117,
                              "end": 120
                            }
                          }
                        },
                        "span": {
                          "start": 117,
                          "end": 120
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 101,
                        "end": 123
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 50,
                "end": 127
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 139,
                      "end": 141
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 132,
                "end": 141
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 144
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 151,
              "end": 152
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 175,
                      "end": 186
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 197,
                          "end": 199
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 187,
                        "end": 199
                      }
                    },
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 211,
                          "end": 213
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 201,
                        "end": 213
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 159,
                "end": 217
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 229,
                      "end": 231
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 222,
                "end": 231
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 145,
        "end": 234
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 234
  }
}
