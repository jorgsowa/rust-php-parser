===source===
<?php

#[
    A1,
    A2(),
    A3(0),
    A4(x: 1),
]
function a() {
}

#[A5]
class C {
    #[A6]
    public function m(
        #[A7] $param,
    ) {}
    #[A14]
    public $prop;
}

#[A8]
interface I {}
#[A9]
trait T {}

$x = #[A10] function() {};
$y = #[A11] fn() => 0;
$a = #[A12] static function() {};
$b = #[A13] static fn() => 0;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "a",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "A1"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 14,
                  "end": 16,
                  "start_line": 4,
                  "start_col": 4
                }
              },
              "args": [],
              "span": {
                "start": 14,
                "end": 16,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "name": {
                "parts": [
                  "A2"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 22,
                  "end": 24,
                  "start_line": 5,
                  "start_col": 4
                }
              },
              "args": [],
              "span": {
                "start": 22,
                "end": 26,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "name": {
                "parts": [
                  "A3"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 32,
                  "end": 34,
                  "start_line": 6,
                  "start_col": 4
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 35,
                      "end": 36,
                      "start_line": 6,
                      "start_col": 7
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 35,
                    "end": 36,
                    "start_line": 6,
                    "start_col": 7
                  }
                }
              ],
              "span": {
                "start": 32,
                "end": 37,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "name": {
                "parts": [
                  "A4"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 43,
                  "end": 45,
                  "start_line": 7,
                  "start_col": 4
                }
              },
              "args": [
                {
                  "name": "x",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 49,
                      "end": 50,
                      "start_line": 7,
                      "start_col": 10
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 46,
                    "end": 50,
                    "start_line": 7,
                    "start_col": 7
                  }
                }
              ],
              "span": {
                "start": 43,
                "end": 51,
                "start_line": 7,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 55,
        "end": 71,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "C",
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
                  "name": "m",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "param",
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "A7"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 132,
                              "end": 134,
                              "start_line": 16,
                              "start_col": 10
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 132,
                            "end": 134,
                            "start_line": 16,
                            "start_col": 10
                          }
                        }
                      ],
                      "span": {
                        "start": 130,
                        "end": 142,
                        "start_line": 16,
                        "start_col": 8
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A6"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 95,
                          "end": 97,
                          "start_line": 14,
                          "start_col": 6
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 95,
                        "end": 97,
                        "start_line": 14,
                        "start_col": 6
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 93,
                "end": 157,
                "start_line": 14,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "prop",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A14"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 159,
                          "end": 162,
                          "start_line": 18,
                          "start_col": 6
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 159,
                        "end": 162,
                        "start_line": 18,
                        "start_col": 6
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 157,
                "end": 180,
                "start_line": 18,
                "start_col": 4
              }
            }
          ],
          "attributes": [
            {
              "name": {
                "parts": [
                  "A5"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 75,
                  "end": 77,
                  "start_line": 12,
                  "start_col": 2
                }
              },
              "args": [],
              "span": {
                "start": 75,
                "end": 77,
                "start_line": 12,
                "start_col": 2
              }
            }
          ]
        }
      },
      "span": {
        "start": 79,
        "end": 183,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Interface": {
          "name": "I",
          "extends": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "A8"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 187,
                  "end": 189,
                  "start_line": 22,
                  "start_col": 2
                }
              },
              "args": [],
              "span": {
                "start": 187,
                "end": 189,
                "start_line": 22,
                "start_col": 2
              }
            }
          ]
        }
      },
      "span": {
        "start": 191,
        "end": 205,
        "start_line": 23,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Trait": {
          "name": "T",
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "A9"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 208,
                  "end": 210,
                  "start_line": 24,
                  "start_col": 2
                }
              },
              "args": [],
              "span": {
                "start": 208,
                "end": 210,
                "start_line": 24,
                "start_col": 2
              }
            }
          ]
        }
      },
      "span": {
        "start": 212,
        "end": 222,
        "start_line": 25,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 224,
                  "end": 226,
                  "start_line": 27,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "A10"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 231,
                            "end": 234,
                            "start_line": 27,
                            "start_col": 7
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 231,
                          "end": 234,
                          "start_line": 27,
                          "start_col": 7
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 229,
                  "end": 249,
                  "start_line": 27,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 224,
            "end": 249,
            "start_line": 27,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 224,
        "end": 251,
        "start_line": 27,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 251,
                  "end": 253,
                  "start_line": 28,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 271,
                        "end": 272,
                        "start_line": 28,
                        "start_col": 20
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "A11"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 258,
                            "end": 261,
                            "start_line": 28,
                            "start_col": 7
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 258,
                          "end": 261,
                          "start_line": 28,
                          "start_col": 7
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 256,
                  "end": 272,
                  "start_line": 28,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 251,
            "end": 272,
            "start_line": 28,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 251,
        "end": 274,
        "start_line": 28,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 274,
                  "end": 276,
                  "start_line": 29,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": true,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "A12"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 281,
                            "end": 284,
                            "start_line": 29,
                            "start_col": 7
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 281,
                          "end": 284,
                          "start_line": 29,
                          "start_col": 7
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 279,
                  "end": 306,
                  "start_line": 29,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 274,
            "end": 306,
            "start_line": 29,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 274,
        "end": 308,
        "start_line": 29,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 308,
                  "end": 310,
                  "start_line": 30,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": true,
                    "by_ref": false,
                    "params": [],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 335,
                        "end": 336,
                        "start_line": 30,
                        "start_col": 27
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "A13"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 315,
                            "end": 318,
                            "start_line": 30,
                            "start_col": 7
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 315,
                          "end": 318,
                          "start_line": 30,
                          "start_col": 7
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 313,
                  "end": 336,
                  "start_line": 30,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 308,
            "end": 336,
            "start_line": 30,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 308,
        "end": 337,
        "start_line": 30,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 337,
    "start_line": 1,
    "start_col": 0
  }
}
