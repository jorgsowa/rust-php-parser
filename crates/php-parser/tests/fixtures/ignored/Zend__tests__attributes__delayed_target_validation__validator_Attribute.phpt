===source===
<?php

#[DelayedTargetValidation]
#[Attribute]
trait DemoTrait {}

#[DelayedTargetValidation]
#[Attribute]
interface DemoInterface {}

#[DelayedTargetValidation]
#[Attribute]
abstract class DemoAbstract {}

#[DelayedTargetValidation]
#[Attribute]
enum DemoEnum {}

$cases = [
	new ReflectionClass('DemoTrait'),
	new ReflectionClass('DemoInterface'),
	new ReflectionClass('DemoAbstract'),
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
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "DemoTrait",
            "span": {
              "start": 53,
              "end": 62
            }
          },
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
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 45
                }
              },
              "args": [],
              "span": {
                "start": 36,
                "end": 45
              }
            }
          ]
        }
      },
      "span": {
        "start": 47,
        "end": 65
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "DemoInterface",
            "span": {
              "start": 117,
              "end": 130
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
                  "start": 69,
                  "end": 92
                }
              },
              "args": [],
              "span": {
                "start": 69,
                "end": 92
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 96,
                  "end": 105
                }
              },
              "args": [],
              "span": {
                "start": 96,
                "end": 105
              }
            }
          ]
        }
      },
      "span": {
        "start": 107,
        "end": 133
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoAbstract",
            "span": {
              "start": 190,
              "end": 202
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                  "start": 137,
                  "end": 160
                }
              },
              "args": [],
              "span": {
                "start": 137,
                "end": 160
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 164,
                  "end": 173
                }
              },
              "args": [],
              "span": {
                "start": 164,
                "end": 173
              }
            }
          ]
        }
      },
      "span": {
        "start": 184,
        "end": 205
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "DemoEnum",
            "span": {
              "start": 252,
              "end": 260
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
                  "start": 209,
                  "end": 232
                }
              },
              "args": [],
              "span": {
                "start": 209,
                "end": 232
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 236,
                  "end": 245
                }
              },
              "args": [],
              "span": {
                "start": 236,
                "end": 245
              }
            }
          ]
        }
      },
      "span": {
        "start": 247,
        "end": 263
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
                  "start": 265,
                  "end": 271
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
                                      "start": 281,
                                      "end": 296
                                    }
                                  }
                                },
                                "span": {
                                  "start": 281,
                                  "end": 296
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "String": "DemoTrait"
                                      },
                                      "span": {
                                        "start": 297,
                                        "end": 308
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 297,
                                    "end": 308
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 277,
                            "end": 309
                          }
                        }
                      },
                      "span": {
                        "start": 277,
                        "end": 309
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
                                      "start": 316,
                                      "end": 331
                                    }
                                  }
                                },
                                "span": {
                                  "start": 316,
                                  "end": 331
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
                                        "start": 332,
                                        "end": 347
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 332,
                                    "end": 347
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 312,
                            "end": 348
                          }
                        }
                      },
                      "span": {
                        "start": 312,
                        "end": 348
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
                                      "start": 355,
                                      "end": 370
                                    }
                                  }
                                },
                                "span": {
                                  "start": 355,
                                  "end": 370
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "String": "DemoAbstract"
                                      },
                                      "span": {
                                        "start": 371,
                                        "end": 385
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 371,
                                    "end": 385
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 351,
                            "end": 386
                          }
                        }
                      },
                      "span": {
                        "start": 351,
                        "end": 386
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
                                      "start": 393,
                                      "end": 408
                                    }
                                  }
                                },
                                "span": {
                                  "start": 393,
                                  "end": 408
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
                                        "start": 409,
                                        "end": 419
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 409,
                                    "end": 419
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 389,
                            "end": 420
                          }
                        }
                      },
                      "span": {
                        "start": 389,
                        "end": 420
                      }
                    }
                  ]
                },
                "span": {
                  "start": 274,
                  "end": 423
                }
              }
            }
          },
          "span": {
            "start": 265,
            "end": 423
          }
        }
      },
      "span": {
        "start": 265,
        "end": 424
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
              "start": 434,
              "end": 440
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "r"
            },
            "span": {
              "start": 444,
              "end": 446
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
                                          "start": 456,
                                          "end": 466
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 456,
                                      "end": 466
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
                                            "start": 467,
                                            "end": 470
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 467,
                                        "end": 470
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
                                            "start": 472,
                                            "end": 474
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 472,
                                        "end": 474
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 456,
                                "end": 475
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "\n"
                              },
                              "span": {
                                "start": 478,
                                "end": 482
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 456,
                          "end": 482
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 451,
                    "end": 483
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
                                "start": 490,
                                "end": 492
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "\n"
                              },
                              "span": {
                                "start": 495,
                                "end": 499
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 490,
                          "end": 499
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 485,
                    "end": 500
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
                              "start": 502,
                              "end": 513
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
                                    "start": 516,
                                    "end": 518
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "getAttributes"
                                  },
                                  "span": {
                                    "start": 520,
                                    "end": 533
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 516,
                              "end": 535
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 502,
                        "end": 535
                      }
                    }
                  },
                  "span": {
                    "start": 502,
                    "end": 536
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
                                  "start": 538,
                                  "end": 546
                                }
                              }
                            },
                            "span": {
                              "start": 538,
                              "end": 546
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
                                    "start": 547,
                                    "end": 558
                                  }
                                }
                              },
                              "span": {
                                "start": 547,
                                "end": 558
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 538,
                        "end": 559
                      }
                    }
                  },
                  "span": {
                    "start": 538,
                    "end": 560
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
                                            "start": 570,
                                            "end": 581
                                          }
                                        },
                                        "index": {
                                          "kind": {
                                            "Int": 1
                                          },
                                          "span": {
                                            "start": 582,
                                            "end": 583
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 570,
                                      "end": 584
                                    }
                                  },
                                  "method": {
                                    "kind": {
                                      "Identifier": "newInstance"
                                    },
                                    "span": {
                                      "start": 586,
                                      "end": 597
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 570,
                                "end": 599
                              }
                            }
                          },
                          "span": {
                            "start": 570,
                            "end": 600
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
                                "start": 611,
                                "end": 616
                              }
                            }
                          ],
                          "var": {
                            "name": "e",
                            "span": {
                              "start": 617,
                              "end": 619
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
                                                                  "start": 630,
                                                                  "end": 639
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 630,
                                                              "end": 639
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
                                                                    "start": 640,
                                                                    "end": 642
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 640,
                                                                "end": 642
                                                              }
                                                            }
                                                          ]
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 630,
                                                        "end": 643
                                                      }
                                                    },
                                                    "op": "Concat",
                                                    "right": {
                                                      "kind": {
                                                        "String": ": "
                                                      },
                                                      "span": {
                                                        "start": 646,
                                                        "end": 650
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 630,
                                                  "end": 650
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
                                                        "start": 653,
                                                        "end": 655
                                                      }
                                                    },
                                                    "method": {
                                                      "kind": {
                                                        "Identifier": "getMessage"
                                                      },
                                                      "span": {
                                                        "start": 657,
                                                        "end": 667
                                                      }
                                                    },
                                                    "args": []
                                                  }
                                                },
                                                "span": {
                                                  "start": 653,
                                                  "end": 669
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 630,
                                            "end": 669
                                          }
                                        },
                                        "op": "Concat",
                                        "right": {
                                          "kind": {
                                            "String": "\n"
                                          },
                                          "span": {
                                            "start": 672,
                                            "end": 676
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 630,
                                      "end": 676
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 625,
                                "end": 677
                              }
                            }
                          ],
                          "span": {
                            "start": 610,
                            "end": 680
                          }
                        }
                      ],
                      "finally": null
                    }
                  },
                  "span": {
                    "start": 562,
                    "end": 680
                  }
                }
              ]
            },
            "span": {
              "start": 448,
              "end": 682
            }
          }
        }
      },
      "span": {
        "start": 425,
        "end": 682
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 682
  }
}
