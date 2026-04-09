===source===
<?php echo Foo::class;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Identifier": "Foo"
                  },
                  "span": {
                    "start": 11,
                    "end": 14,
                    "start_line": 1,
                    "start_col": 11
                  }
                },
                "member": "class"
              }
            },
            "span": {
              "start": 11,
              "end": 21,
              "start_line": 1,
              "start_col": 11
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22,
    "start_line": 1,
    "start_col": 0
  }
}
