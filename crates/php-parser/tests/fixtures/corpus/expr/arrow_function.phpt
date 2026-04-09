===source===
<?php
fn(bool $a) => $a;
fn($x = 42) => $x;
static fn(&$x) => $x;
fn&($x) => $x;
fn($x, ...$rest) => $rest;
fn(): int => $x;

fn($a, $b) => $a and $b;
fn($a, $b) => $a && $b;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": "a",
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "bool"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 9,
                          "end": 13,
                          "start_line": 2,
                          "start_col": 3
                        }
                      }
                    },
                    "span": {
                      "start": 9,
                      "end": 13,
                      "start_line": 2,
                      "start_col": 3
                    }
                  },
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "is_readonly": false,
                  "is_final": false,
                  "visibility": null,
                  "set_visibility": null,
                  "attributes": [],
                  "span": {
                    "start": 9,
                    "end": 16,
                    "start_line": 2,
                    "start_col": 3
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 21,
                  "end": 23,
                  "start_line": 2,
                  "start_col": 15
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": "x",
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 33,
                      "end": 35,
                      "start_line": 3,
                      "start_col": 8
                    }
                  },
                  "by_ref": false,
                  "variadic": false,
                  "is_readonly": false,
                  "is_final": false,
                  "visibility": null,
                  "set_visibility": null,
                  "attributes": [],
                  "span": {
                    "start": 28,
                    "end": 35,
                    "start_line": 3,
                    "start_col": 3
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 40,
                  "end": 42,
                  "start_line": 3,
                  "start_col": 15
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 25,
            "end": 42,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 44,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": true,
              "by_ref": false,
              "params": [
                {
                  "name": "x",
                  "type_hint": null,
                  "default": null,
                  "by_ref": true,
                  "variadic": false,
                  "is_readonly": false,
                  "is_final": false,
                  "visibility": null,
                  "set_visibility": null,
                  "attributes": [],
                  "span": {
                    "start": 54,
                    "end": 57,
                    "start_line": 4,
                    "start_col": 10
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 62,
                  "end": 64,
                  "start_line": 4,
                  "start_col": 18
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 44,
            "end": 64,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 44,
        "end": 66,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": true,
              "params": [
                {
                  "name": "x",
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
                    "start": 70,
                    "end": 72,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 77,
                  "end": 79,
                  "start_line": 5,
                  "start_col": 11
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 66,
            "end": 79,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 66,
        "end": 81,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": "x",
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
                    "start": 84,
                    "end": 86,
                    "start_line": 6,
                    "start_col": 3
                  }
                },
                {
                  "name": "rest",
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": true,
                  "is_readonly": false,
                  "is_final": false,
                  "visibility": null,
                  "set_visibility": null,
                  "attributes": [],
                  "span": {
                    "start": 88,
                    "end": 96,
                    "start_line": 6,
                    "start_col": 7
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Variable": "rest"
                },
                "span": {
                  "start": 101,
                  "end": 106,
                  "start_line": 6,
                  "start_col": 20
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 81,
            "end": 106,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 81,
        "end": 108,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "return_type": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 114,
                      "end": 117,
                      "start_line": 7,
                      "start_col": 6
                    }
                  }
                },
                "span": {
                  "start": 114,
                  "end": 117,
                  "start_line": 7,
                  "start_col": 6
                }
              },
              "body": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 121,
                  "end": 123,
                  "start_line": 7,
                  "start_col": 13
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 108,
            "end": 123,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 108,
        "end": 126,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
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
                    "start": 129,
                    "end": 131,
                    "start_line": 9,
                    "start_col": 3
                  }
                },
                {
                  "name": "b",
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
                    "start": 133,
                    "end": 135,
                    "start_line": 9,
                    "start_col": 7
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 140,
                        "end": 142,
                        "start_line": 9,
                        "start_col": 14
                      }
                    },
                    "op": "LogicalAnd",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 147,
                        "end": 149,
                        "start_line": 9,
                        "start_col": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 140,
                  "end": 149,
                  "start_line": 9,
                  "start_col": 14
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 126,
            "end": 149,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 126,
        "end": 151,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
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
                    "start": 154,
                    "end": 156,
                    "start_line": 10,
                    "start_col": 3
                  }
                },
                {
                  "name": "b",
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
                    "start": 158,
                    "end": 160,
                    "start_line": 10,
                    "start_col": 7
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 165,
                        "end": 167,
                        "start_line": 10,
                        "start_col": 14
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 171,
                        "end": 173,
                        "start_line": 10,
                        "start_col": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 165,
                  "end": 173,
                  "start_line": 10,
                  "start_col": 14
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 151,
            "end": 173,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 151,
        "end": 174,
        "start_line": 10,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 174,
    "start_line": 1,
    "start_col": 0
  }
}
