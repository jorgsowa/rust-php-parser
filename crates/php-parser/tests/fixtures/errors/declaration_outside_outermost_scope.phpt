===source===
<?php
function f() {
    const X = 1;
    #[A] const Y = 2;
    use A\B;
    namespace C;
}
if (1) { const Z = 3; }
declare(ticks=1) { use D; }
===errors <=7.4===
'const' declarations can only be used at the outermost scope
'use' declarations can only be used at the outermost scope
namespace declarations can only be used at the outermost scope
'const' declarations can only be used at the outermost scope
'use' declarations can only be used at the outermost scope
===errors 8.0-8.4===
'const' declarations can only be used at the outermost scope
'const' declarations can only be used at the outermost scope
'attributes on constants' requires PHP 8.5 or higher
'use' declarations can only be used at the outermost scope
namespace declarations can only be used at the outermost scope
'const' declarations can only be used at the outermost scope
'use' declarations can only be used at the outermost scope
===errors >=8.5===
'const' declarations can only be used at the outermost scope
'const' declarations can only be used at the outermost scope
'use' declarations can only be used at the outermost scope
namespace declarations can only be used at the outermost scope
'const' declarations can only be used at the outermost scope
'use' declarations can only be used at the outermost scope
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'const' (T_CONST) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 3
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Const": [
                  {
                    "name": {
                      "name": "X",
                      "span": {
                        "start": 31,
                        "end": 32
                      }
                    },
                    "value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 35,
                        "end": 36
                      }
                    },
                    "attributes": [],
                    "span": {
                      "start": 31,
                      "end": 36
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 37
              }
            },
            {
              "kind": {
                "Use": {
                  "kind": "Normal",
                  "uses": [
                    {
                      "name": {
                        "parts": [
                          "A",
                          "B"
                        ],
                        "kind": "Qualified",
                        "span": {
                          "start": 68,
                          "end": 71
                        }
                      },
                      "alias": null,
                      "span": {
                        "start": 68,
                        "end": 71
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 64,
                "end": 72
              }
            },
            {
              "kind": {
                "Namespace": {
                  "name": {
                    "parts": [
                      "C"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 87,
                      "end": 88
                    }
                  },
                  "body": "Simple"
                }
              },
              "span": {
                "start": 77,
                "end": 89
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 91
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 96,
              "end": 97
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Const": [
                      {
                        "name": {
                          "name": "Z",
                          "span": {
                            "start": 107,
                            "end": 108
                          }
                        },
                        "value": {
                          "kind": {
                            "Int": 3
                          },
                          "span": {
                            "start": 111,
                            "end": 112
                          }
                        },
                        "attributes": [],
                        "span": {
                          "start": 107,
                          "end": 112
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 101,
                    "end": 113
                  }
                }
              ]
            },
            "span": {
              "start": 99,
              "end": 115
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 92,
        "end": 115
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 130,
                  "end": 131
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Use": {
                      "kind": "Normal",
                      "uses": [
                        {
                          "name": {
                            "parts": [
                              "D"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 139,
                              "end": 140
                            }
                          },
                          "alias": null,
                          "span": {
                            "start": 139,
                            "end": 140
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 135,
                    "end": 141
                  }
                }
              ]
            },
            "span": {
              "start": 133,
              "end": 143
            }
          }
        }
      },
      "span": {
        "start": 116,
        "end": 143
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 143
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Const": [
                  {
                    "name": {
                      "name": "X",
                      "span": {
                        "start": 31,
                        "end": 32
                      }
                    },
                    "value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 35,
                        "end": 36
                      }
                    },
                    "attributes": [],
                    "span": {
                      "start": 31,
                      "end": 36
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 37
              }
            },
            {
              "kind": {
                "Const": [
                  {
                    "name": {
                      "name": "Y",
                      "span": {
                        "start": 53,
                        "end": 54
                      }
                    },
                    "value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 57,
                        "end": 58
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 44,
                            "end": 45
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 44,
                          "end": 45
                        }
                      }
                    ],
                    "span": {
                      "start": 53,
                      "end": 58
                    }
                  }
                ]
              },
              "span": {
                "start": 42,
                "end": 59
              }
            },
            {
              "kind": {
                "Use": {
                  "kind": "Normal",
                  "uses": [
                    {
                      "name": {
                        "parts": [
                          "A",
                          "B"
                        ],
                        "kind": "Qualified",
                        "span": {
                          "start": 68,
                          "end": 71
                        }
                      },
                      "alias": null,
                      "span": {
                        "start": 68,
                        "end": 71
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 64,
                "end": 72
              }
            },
            {
              "kind": {
                "Namespace": {
                  "name": {
                    "parts": [
                      "C"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 87,
                      "end": 88
                    }
                  },
                  "body": "Simple"
                }
              },
              "span": {
                "start": 77,
                "end": 89
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 91
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 96,
              "end": 97
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Const": [
                      {
                        "name": {
                          "name": "Z",
                          "span": {
                            "start": 107,
                            "end": 108
                          }
                        },
                        "value": {
                          "kind": {
                            "Int": 3
                          },
                          "span": {
                            "start": 111,
                            "end": 112
                          }
                        },
                        "attributes": [],
                        "span": {
                          "start": 107,
                          "end": 112
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 101,
                    "end": 113
                  }
                }
              ]
            },
            "span": {
              "start": 99,
              "end": 115
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 92,
        "end": 115
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 130,
                  "end": 131
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Use": {
                      "kind": "Normal",
                      "uses": [
                        {
                          "name": {
                            "parts": [
                              "D"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 139,
                              "end": 140
                            }
                          },
                          "alias": null,
                          "span": {
                            "start": 139,
                            "end": 140
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 135,
                    "end": 141
                  }
                }
              ]
            },
            "span": {
              "start": 133,
              "end": 143
            }
          }
        }
      },
      "span": {
        "start": 116,
        "end": 143
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 143
  }
}
