===source===
<?php
const A = function () {};
const B = static function () use ($x) {};
class C {
    const D = function () {};
    public $e = static function () use (&$y) {};
}
#[Attr(function () {})]
function f() {}
===errors===
Closures in constant expressions must be static
Cannot use(...) variables in constant expression
Closures in constant expressions must be static
Cannot use(...) variables in constant expression
Closures in constant expressions must be static
===php_error===
PHP Fatal error:  Closures in constant expressions must be static in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Closure": {
                  "is_static": false,
                  "by_ref": false,
                  "params": [],
                  "use_vars": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 30
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 30
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 31
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 38,
                "end": 39
              }
            },
            "value": {
              "kind": {
                "Closure": {
                  "is_static": true,
                  "by_ref": false,
                  "params": [],
                  "use_vars": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 66,
                          "end": 68
                        }
                      },
                      "by_ref": false,
                      "span": {
                        "start": 66,
                        "end": 68
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 72
              }
            },
            "attributes": [],
            "span": {
              "start": 38,
              "end": 72
            }
          }
        ]
      },
      "span": {
        "start": 32,
        "end": 73
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 80,
              "end": 81
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
                "ClassConst": {
                  "name": {
                    "name": "D",
                    "span": {
                      "start": 94,
                      "end": 95
                    }
                  },
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Closure": {
                        "is_static": false,
                        "by_ref": false,
                        "params": [],
                        "use_vars": [],
                        "return_type": null,
                        "body": [],
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 98,
                      "end": 112
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 88,
                "end": 113
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 125,
                      "end": 127
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Closure": {
                        "is_static": true,
                        "by_ref": false,
                        "params": [],
                        "use_vars": [
                          {
                            "name": {
                              "name": "y",
                              "span": {
                                "start": 155,
                                "end": 157
                              }
                            },
                            "by_ref": true,
                            "span": {
                              "start": 154,
                              "end": 157
                            }
                          }
                        ],
                        "return_type": null,
                        "body": [],
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 130,
                      "end": 161
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 118,
                "end": 161
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 74,
        "end": 164
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 198,
              "end": 199
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 167,
                  "end": 171
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Closure": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [],
                          "use_vars": [],
                          "return_type": null,
                          "body": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 172,
                        "end": 186
                      }
                    }
                  },
                  "span": {
                    "start": 172,
                    "end": 186
                  }
                }
              ],
              "span": {
                "start": 167,
                "end": 187
              }
            }
          ]
        }
      },
      "span": {
        "start": 189,
        "end": 204
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 204
  }
}
