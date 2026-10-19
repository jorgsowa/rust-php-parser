===source===
<?php

#[DelayedTargetValidation]
#[AllowDynamicProperties]
trait DemoTrait {}

#[DelayedTargetValidation]
#[AllowDynamicProperties]
interface DemoInterface {}

#[DelayedTargetValidation]
#[AllowDynamicProperties]
readonly class DemoReadonly {}

#[DelayedTargetValidation]
#[AllowDynamicProperties]
enum DemoEnum {}

$cases = [
	new ReflectionClass('DemoTrait'),
	new ReflectionClass('DemoInterface'),
	new ReflectionClass('DemoReadonly'),
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
              "start": 66,
              "end": 75
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
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 58
                }
              },
              "args": [],
              "span": {
                "start": 36,
                "end": 58
              }
            }
          ]
        }
      },
      "span": {
        "start": 60,
        "end": 78
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "DemoInterface",
            "span": {
              "start": 143,
              "end": 156
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
                  "start": 82,
                  "end": 105
                }
              },
              "args": [],
              "span": {
                "start": 82,
                "end": 105
              }
            },
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 109,
                  "end": 131
                }
              },
              "args": [],
              "span": {
                "start": 109,
                "end": 131
              }
            }
          ]
        }
      },
      "span": {
        "start": 133,
        "end": 159
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoReadonly",
            "span": {
              "start": 229,
              "end": 241
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
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
                  "start": 163,
                  "end": 186
                }
              },
              "args": [],
              "span": {
                "start": 163,
                "end": 186
              }
            },
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 190,
                  "end": 212
                }
              },
              "args": [],
              "span": {
                "start": 190,
                "end": 212
              }
            }
          ]
        }
      },
      "span": {
        "start": 223,
        "end": 244
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "DemoEnum",
            "span": {
              "start": 304,
              "end": 312
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
                  "start": 248,
                  "end": 271
                }
              },
              "args": [],
              "span": {
                "start": 248,
                "end": 271
              }
            },
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 275,
                  "end": 297
                }
              },
              "args": [],
              "span": {
                "start": 275,
                "end": 297
              }
            }
          ]
        }
      },
      "span": {
        "start": 299,
        "end": 315
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
                  "start": 317,
                  "end": 323
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
                                      "start": 333,
                                      "end": 348
                                    }
                                  }
                                },
                                "span": {
                                  "start": 333,
                                  "end": 348
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
                                        "start": 349,
                                        "end": 360
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 349,
                                    "end": 360
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 329,
                            "end": 361
                          }
                        }
                      },
                      "span": {
                        "start": 329,
                        "end": 361
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
                                      "start": 368,
                                      "end": 383
                                    }
                                  }
                                },
                                "span": {
                                  "start": 368,
                                  "end": 383
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
                                        "start": 384,
                                        "end": 399
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 384,
                                    "end": 399
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 364,
                            "end": 400
                          }
                        }
                      },
                      "span": {
                        "start": 364,
                        "end": 400
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
                                      "start": 407,
                                      "end": 422
                                    }
                                  }
                                },
                                "span": {
                                  "start": 407,
                                  "end": 422
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "String": "DemoReadonly"
                                      },
                                      "span": {
                                        "start": 423,
                                        "end": 437
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 423,
                                    "end": 437
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 403,
                            "end": 438
                          }
                        }
                      },
                      "span": {
                        "start": 403,
                        "end": 438
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
                                      "start": 445,
                                      "end": 460
                                    }
                                  }
                                },
                                "span": {
                                  "start": 445,
                                  "end": 460
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
                                        "start": 461,
                                        "end": 471
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 461,
                                    "end": 471
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 441,
                            "end": 472
                          }
                        }
                      },
                      "span": {
                        "start": 441,
                        "end": 472
                      }
                    }
                  ]
                },
                "span": {
                  "start": 326,
                  "end": 475
                }
              }
            }
          },
          "span": {
            "start": 317,
            "end": 475
          }
        }
      },
      "span": {
        "start": 317,
        "end": 476
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
              "start": 486,
              "end": 492
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "r"
            },
            "span": {
              "start": 496,
              "end": 498
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
                                          "start": 508,
                                          "end": 518
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 508,
                                      "end": 518
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
                                            "start": 519,
                                            "end": 522
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 519,
                                        "end": 522
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
                                            "start": 524,
                                            "end": 526
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 524,
                                        "end": 526
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 508,
                                "end": 527
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "\n"
                              },
                              "span": {
                                "start": 530,
                                "end": 534
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 508,
                          "end": 534
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 503,
                    "end": 535
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
                                "start": 542,
                                "end": 544
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "\n"
                              },
                              "span": {
                                "start": 547,
                                "end": 551
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 542,
                          "end": 551
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 537,
                    "end": 552
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
                              "start": 554,
                              "end": 565
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
                                    "start": 568,
                                    "end": 570
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "getAttributes"
                                  },
                                  "span": {
                                    "start": 572,
                                    "end": 585
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 568,
                              "end": 587
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 554,
                        "end": 587
                      }
                    }
                  },
                  "span": {
                    "start": 554,
                    "end": 588
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
                                  "start": 590,
                                  "end": 598
                                }
                              }
                            },
                            "span": {
                              "start": 590,
                              "end": 598
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
                                    "start": 599,
                                    "end": 610
                                  }
                                }
                              },
                              "span": {
                                "start": 599,
                                "end": 610
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 590,
                        "end": 611
                      }
                    }
                  },
                  "span": {
                    "start": 590,
                    "end": 612
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
                                            "start": 622,
                                            "end": 633
                                          }
                                        },
                                        "index": {
                                          "kind": {
                                            "Int": 1
                                          },
                                          "span": {
                                            "start": 634,
                                            "end": 635
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 622,
                                      "end": 636
                                    }
                                  },
                                  "method": {
                                    "kind": {
                                      "Identifier": "newInstance"
                                    },
                                    "span": {
                                      "start": 638,
                                      "end": 649
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 622,
                                "end": 651
                              }
                            }
                          },
                          "span": {
                            "start": 622,
                            "end": 652
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
                                "start": 663,
                                "end": 668
                              }
                            }
                          ],
                          "var": {
                            "name": "e",
                            "span": {
                              "start": 669,
                              "end": 671
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
                                                                  "start": 682,
                                                                  "end": 691
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 682,
                                                              "end": 691
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
                                                                    "start": 692,
                                                                    "end": 694
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 692,
                                                                "end": 694
                                                              }
                                                            }
                                                          ]
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 682,
                                                        "end": 695
                                                      }
                                                    },
                                                    "op": "Concat",
                                                    "right": {
                                                      "kind": {
                                                        "String": ": "
                                                      },
                                                      "span": {
                                                        "start": 698,
                                                        "end": 702
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 682,
                                                  "end": 702
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
                                                        "start": 705,
                                                        "end": 707
                                                      }
                                                    },
                                                    "method": {
                                                      "kind": {
                                                        "Identifier": "getMessage"
                                                      },
                                                      "span": {
                                                        "start": 709,
                                                        "end": 719
                                                      }
                                                    },
                                                    "args": []
                                                  }
                                                },
                                                "span": {
                                                  "start": 705,
                                                  "end": 721
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 682,
                                            "end": 721
                                          }
                                        },
                                        "op": "Concat",
                                        "right": {
                                          "kind": {
                                            "String": "\n"
                                          },
                                          "span": {
                                            "start": 724,
                                            "end": 728
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 682,
                                      "end": 728
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 677,
                                "end": 729
                              }
                            }
                          ],
                          "span": {
                            "start": 662,
                            "end": 732
                          }
                        }
                      ],
                      "finally": null
                    }
                  },
                  "span": {
                    "start": 614,
                    "end": 732
                  }
                }
              ]
            },
            "span": {
              "start": 500,
              "end": 734
            }
          }
        }
      },
      "span": {
        "start": 477,
        "end": 734
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 734
  }
}
