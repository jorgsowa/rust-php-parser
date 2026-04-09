===source===
<?php
function($a) { $a; };
function($a) use($b) {};
function() use($a, &$b) {};
function &($a) {};
static function() {};
function($a) : array {};
function() use($a) : \Foo\Bar {};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": "a",
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "is_readonly": false,
                  "is_final": false,
                  "visibility": null,
                  "set_visibility": null,
                  "attributes": [],
                  "span": {
                    "start": 15,
                    "end": 17,
                    "start_line": 2,
                    "start_col": 9
                  }
                }
              ],
              "use_vars": [],
              "return_type": null,
              "body": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 21,
                        "end": 23,
                        "start_line": 2,
                        "start_col": 15
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 25,
                    "start_line": 2,
                    "start_col": 15
                  }
                }
              ],
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 26,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": "a",
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "is_readonly": false,
                  "is_final": false,
                  "visibility": null,
                  "set_visibility": null,
                  "attributes": [],
                  "span": {
                    "start": 37,
                    "end": 39,
                    "start_line": 3,
                    "start_col": 9
                  }
                }
              ],
              "use_vars": [
                {
                  "name": "b",
                  "by_ref": false,
                  "span": {
                    "start": 45,
                    "end": 47,
                    "start_line": 3,
                    "start_col": 17
                  }
                }
              ],
              "return_type": null,
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 28,
            "end": 51,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 28,
        "end": 53,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "use_vars": [
                {
                  "name": "a",
                  "by_ref": false,
                  "span": {
                    "start": 68,
                    "end": 70,
                    "start_line": 4,
                    "start_col": 15
                  }
                },
                {
                  "name": "b",
                  "by_ref": true,
                  "span": {
                    "start": 72,
                    "end": 75,
                    "start_line": 4,
                    "start_col": 19
                  }
                }
              ],
              "return_type": null,
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 53,
            "end": 79,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 53,
        "end": 81,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": true,
              "params": [
                {
                  "name": "a",
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "is_readonly": false,
                  "is_final": false,
                  "visibility": null,
                  "set_visibility": null,
                  "attributes": [],
                  "span": {
                    "start": 92,
                    "end": 94,
                    "start_line": 5,
                    "start_col": 11
                  }
                }
              ],
              "use_vars": [],
              "return_type": null,
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 81,
            "end": 98,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 81,
        "end": 100,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": true,
              "by_ref": false,
              "params": [],
              "use_vars": [],
              "return_type": null,
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 100,
            "end": 120,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 100,
        "end": 122,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": "a",
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "is_readonly": false,
                  "is_final": false,
                  "visibility": null,
                  "set_visibility": null,
                  "attributes": [],
                  "span": {
                    "start": 131,
                    "end": 133,
                    "start_line": 7,
                    "start_col": 9
                  }
                }
              ],
              "use_vars": [],
              "return_type": {
                "kind": {
                  "Named": {
                    "parts": [
                      "array"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 137,
                      "end": 142,
                      "start_line": 7,
                      "start_col": 15
                    }
                  }
                },
                "span": {
                  "start": 137,
                  "end": 142,
                  "start_line": 7,
                  "start_col": 15
                }
              },
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 122,
            "end": 145,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 122,
        "end": 147,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "use_vars": [
                {
                  "name": "a",
                  "by_ref": false,
                  "span": {
                    "start": 162,
                    "end": 164,
                    "start_line": 8,
                    "start_col": 15
                  }
                }
              ],
              "return_type": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Foo",
                      "Bar"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 168,
                      "end": 177,
                      "start_line": 8,
                      "start_col": 21
                    }
                  }
                },
                "span": {
                  "start": 168,
                  "end": 177,
                  "start_line": 8,
                  "start_col": 21
                }
              },
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 147,
            "end": 179,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 147,
        "end": 180,
        "start_line": 8,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 180,
    "start_line": 1,
    "start_col": 0
  }
}
