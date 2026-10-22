===source===
<?php
function f(A&Enum $x, enum&A $y, A & Enum &$z): A&Enum {}
class C { public A&Enum $p; }
$f = fn(A&Enum ...$x) => 1;
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Enum' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Enum", expecting variable in Standard input code on line 2
===ast===
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
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 24,
                  "end": 26
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 17,
                            "end": 18
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 18
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Enum"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 23
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 23
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 23
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 26
              }
            },
            {
              "name": {
                "name": "y",
                "span": {
                  "start": 35,
                  "end": 37
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "enum"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 28,
                            "end": 32
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 32
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 33,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 34
                      }
                    }
                  ]
                },
                "span": {
                  "start": 28,
                  "end": 34
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 28,
                "end": 37
              }
            },
            {
              "name": {
                "name": "z",
                "span": {
                  "start": 49,
                  "end": 51
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 39,
                            "end": 40
                          }
                        }
                      },
                      "span": {
                        "start": 39,
                        "end": 40
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Enum"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 43,
                            "end": 47
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 47
                      }
                    }
                  ]
                },
                "span": {
                  "start": 39,
                  "end": 47
                }
              },
              "default": null,
              "by_ref": true,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 39,
                "end": 51
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Intersection": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 54,
                        "end": 55
                      }
                    }
                  },
                  "span": {
                    "start": 54,
                    "end": 55
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Enum"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 56,
                        "end": 60
                      }
                    }
                  },
                  "span": {
                    "start": 56,
                    "end": 60
                  }
                }
              ]
            },
            "span": {
              "start": 54,
              "end": 60
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 70,
              "end": 71
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
                    "name": "p",
                    "span": {
                      "start": 88,
                      "end": 90
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Intersection": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 81,
                                "end": 82
                              }
                            }
                          },
                          "span": {
                            "start": 81,
                            "end": 82
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Enum"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 83,
                                "end": 87
                              }
                            }
                          },
                          "span": {
                            "start": 83,
                            "end": 87
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 81,
                      "end": 87
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 74,
                "end": 90
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 64,
        "end": 93
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 94,
                  "end": 96
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 112,
                            "end": 114
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "A"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 102,
                                      "end": 103
                                    }
                                  }
                                },
                                "span": {
                                  "start": 102,
                                  "end": 103
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Enum"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 104,
                                      "end": 108
                                    }
                                  }
                                },
                                "span": {
                                  "start": 104,
                                  "end": 108
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 102,
                            "end": 108
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": true,
                        "attributes": [],
                        "span": {
                          "start": 102,
                          "end": 114
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 119,
                        "end": 120
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 99,
                  "end": 120
                }
              }
            }
          },
          "span": {
            "start": 94,
            "end": 120
          }
        }
      },
      "span": {
        "start": 94,
        "end": 121
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 121
  }
}
