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
                    "end": 14
                  }
                },
                "member": "class"
              }
            },
            "span": {
              "start": 11,
              "end": 21
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
