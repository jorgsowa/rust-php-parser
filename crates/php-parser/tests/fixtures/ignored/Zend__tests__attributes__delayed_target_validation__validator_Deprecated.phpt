===source===
<?php

#[DelayedTargetValidation]
#[Deprecated]
interface DemoInterface {}

#[DelayedTargetValidation]
#[Deprecated]
class DemoClass {}

#[DelayedTargetValidation]
#[Deprecated]
enum DemoEnum {}

$cases = [
	new ReflectionClass('DemoInterface'),
	new ReflectionClass('DemoClass'),
	new ReflectionClass('DemoEnum'),
];
foreach ($cases as $r) {
	echo str_repeat("*", 20) . "\n";
	echo $r . "\n";
	$attributes = $r->getAttributes();
	var_dump($attributes);
	try {
		$attributes[1]->newInstance();
	} catch (Error $e) {
		echo get_class($e) . ": " . $e->getMessage() . "\n";
	}
}

?>
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "enum" in Standard input code on line 13
===php_error 8.4===
PHP Fatal error:  Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant) in Standard input code on line 5
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "DemoInterface",
            "span": {
              "start": 58,
              "end": 71
            }
          },
          "extends": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 9,
                  "end": 32
                }
              },
              "args": [],
              "span": {
                "start": 9,
                "end": 32
              }
            },
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 46
                }
              },
              "args": [],
              "span": {
                "start": 36,
                "end": 46
              }
            }
          ]
        }
      },
      "span": {
        "start": 48,
        "end": 74
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoClass",
            "span": {
              "start": 123,
              "end": 132
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
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 78,
                  "end": 101
                }
              },
              "args": [],
              "span": {
                "start": 78,
                "end": 101
              }
            },
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 105,
                  "end": 115
                }
              },
              "args": [],
              "span": {
                "start": 105,
                "end": 115
              }
            }
          ]
        }
      },
      "span": {
        "start": 117,
        "end": 135
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "DemoEnum",
            "span": {
              "start": 183,
              "end": 191
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 139,
                  "end": 162
                }
              },
              "args": [],
              "span": {
                "start": 139,
                "end": 162
              }
            },
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 166,
                  "end": 176
                }
              },
              "args": [],
              "span": {
                "start": 166,
                "end": 176
              }
            }
          ]
        }
      },
      "span": {
        "start": 178,
        "end": 194
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "cases"
                },
                "span": {
                  "start": 196,
                  "end": 202
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "ReflectionClass"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 212,
                                      "end": 227
                                    }
                                  }
                                },
                                "span": {
                                  "start": 212,
                                  "end": 227
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "String": "DemoInterface"
                                      },
                                      "span": {
                                        "start": 228,
                                        "end": 243
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 228,
                                    "end": 243
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 208,
                            "end": 244
                          }
                        }
                      },
                      "span": {
                        "start": 208,
                        "end": 244
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "ReflectionClass"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 251,
                                      "end": 266
                                    }
                                  }
                                },
                                "span": {
                                  "start": 251,
                                  "end": 266
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "String": "DemoClass"
                                      },
                                      "span": {
                                        "start": 267,
                                        "end": 278
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 267,
                                    "end": 278
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 247,
                            "end": 279
                          }
                        }
                      },
                      "span": {
                        "start": 247,
                        "end": 279
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "ReflectionClass"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 286,
                                      "end": 301
                                    }
                                  }
                                },
                                "span": {
                                  "start": 286,
                                  "end": 301
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "String": "DemoEnum"
                                      },
                                      "span": {
                                        "start": 302,
                                        "end": 312
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 302,
                                    "end": 312
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 282,
                            "end": 313
                          }
                        }
                      },
                      "span": {
                        "start": 282,
                        "end": 313
                      }
                    }
                  ]
                },
                "span": {
                  "start": 205,
                  "end": 316
                }
              }
            }
          },
          "span": {
            "start": 196,
            "end": 316
          }
        }
      },
      "span": {
        "start": 196,
        "end": 317
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "cases"
            },
            "span": {
              "start": 327,
              "end": 333
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "r"
            },
            "span": {
              "start": 337,
              "end": 339
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "str_repeat"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 349,
                                          "end": 359
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 349,
                                      "end": 359
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "String": "*"
                                          },
                                          "span": {
                                            "start": 360,
                                            "end": 363
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 360,
                                        "end": 363
                                      }
                                    },
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "Int": 20
                                          },
                                          "span": {
                                            "start": 365,
                                            "end": 367
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 365,
                                        "end": 367
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 349,
                                "end": 368
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "\n"
                              },
                              "span": {
                                "start": 371,
                                "end": 375
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 349,
                          "end": 375
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 344,
                    "end": 376
                  }
                },
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Variable": "r"
                              },
                              "span": {
                                "start": 383,
                                "end": 385
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "\n"
                              },
                              "span": {
                                "start": 388,
                                "end": 392
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 383,
                          "end": 392
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 378,
                    "end": 393
                  }
                },
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "attributes"
                            },
                            "span": {
                              "start": 395,
                              "end": 406
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "MethodCall": {
                                "object": {
                                  "kind": {
                                    "Variable": "r"
                                  },
                                  "span": {
                                    "start": 409,
                                    "end": 411
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "getAttributes"
                                  },
                                  "span": {
                                    "start": 413,
                                    "end": 426
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 409,
                              "end": 428
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 395,
                        "end": 428
                      }
                    }
                  },
                  "span": {
                    "start": 395,
                    "end": 429
                  }
                },
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "var_dump"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 431,
                                  "end": 439
                                }
                              }
                            },
                            "span": {
                              "start": 431,
                              "end": 439
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Variable": "attributes"
                                  },
                                  "span": {
                                    "start": 440,
                                    "end": 451
                                  }
                                }
                              },
                              "span": {
                                "start": 440,
                                "end": 451
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 431,
                        "end": 452
                      }
                    }
                  },
                  "span": {
                    "start": 431,
                    "end": 453
                  }
                },
                {
                  "kind": {
                    "TryCatch": {
                      "body": [
                        {
                          "kind": {
                            "Expression": {
                              "kind": {
                                "MethodCall": {
                                  "object": {
                                    "kind": {
                                      "ArrayAccess": {
                                        "array": {
                                          "kind": {
                                            "Variable": "attributes"
                                          },
                                          "span": {
                                            "start": 463,
                                            "end": 474
                                          }
                                        },
                                        "index": {
                                          "kind": {
                                            "Int": 1
                                          },
                                          "span": {
                                            "start": 475,
                                            "end": 476
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 463,
                                      "end": 477
                                    }
                                  },
                                  "method": {
                                    "kind": {
                                      "Identifier": "newInstance"
                                    },
                                    "span": {
                                      "start": 479,
                                      "end": 490
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 463,
                                "end": 492
                              }
                            }
                          },
                          "span": {
                            "start": 463,
                            "end": 493
                          }
                        }
                      ],
                      "catches": [
                        {
                          "types": [
                            {
                              "parts": [
                                "Error"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 504,
                                "end": 509
                              }
                            }
                          ],
                          "var": {
                            "name": "e",
                            "span": {
                              "start": 510,
                              "end": 512
                            }
                          },
                          "body": [
                            {
                              "kind": {
                                "Echo": [
                                  {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "Binary": {
                                              "left": {
                                                "kind": {
                                                  "Binary": {
                                                    "left": {
                                                      "kind": {
                                                        "FunctionCall": {
                                                          "name": {
                                                            "kind": {
                                                              "Name": {
                                                                "parts": [
                                                                  "get_class"
                                                                ],
                                                                "kind": "Unqualified",
                                                                "span": {
                                                                  "start": 523,
                                                                  "end": 532
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 523,
                                                              "end": 532
                                                            }
                                                          },
                                                          "args": [
                                                            {
                                                              "name": null,
                                                              "kind": {
                                                                "Value": {
                                                                  "kind": {
                                                                    "Variable": "e"
                                                                  },
                                                                  "span": {
                                                                    "start": 533,
                                                                    "end": 535
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 533,
                                                                "end": 535
                                                              }
                                                            }
                                                          ]
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 523,
                                                        "end": 536
                                                      }
                                                    },
                                                    "op": "Concat",
                                                    "right": {
                                                      "kind": {
                                                        "String": ": "
                                                      },
                                                      "span": {
                                                        "start": 539,
                                                        "end": 543
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 523,
                                                  "end": 543
                                                }
                                              },
                                              "op": "Concat",
                                              "right": {
                                                "kind": {
                                                  "MethodCall": {
                                                    "object": {
                                                      "kind": {
                                                        "Variable": "e"
                                                      },
                                                      "span": {
                                                        "start": 546,
                                                        "end": 548
                                                      }
                                                    },
                                                    "method": {
                                                      "kind": {
                                                        "Identifier": "getMessage"
                                                      },
                                                      "span": {
                                                        "start": 550,
                                                        "end": 560
                                                      }
                                                    },
                                                    "args": []
                                                  }
                                                },
                                                "span": {
                                                  "start": 546,
                                                  "end": 562
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 523,
                                            "end": 562
                                          }
                                        },
                                        "op": "Concat",
                                        "right": {
                                          "kind": {
                                            "String": "\n"
                                          },
                                          "span": {
                                            "start": 565,
                                            "end": 569
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 523,
                                      "end": 569
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 518,
                                "end": 570
                              }
                            }
                          ],
                          "span": {
                            "start": 503,
                            "end": 573
                          }
                        }
                      ],
                      "finally": null
                    }
                  },
                  "span": {
                    "start": 455,
                    "end": 573
                  }
                }
              ]
            },
            "span": {
              "start": 341,
              "end": 575
            }
          }
        }
      },
      "span": {
        "start": 318,
        "end": 575
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 575
  }
}
