<?
//Test the PH7 assertion mechansim
  
// assert failures
function assert_failure()
{
    echo 'Assert failed..Exiting'.PHP_EOL;
}

// This is our test function
function test_assert($parameter)
{
    assert(is_bool($parameter));
}

// Set our assert options
assert_options(ASSERT_ACTIVE,   true);
assert_options(ASSERT_BAIL,     true);
assert_options(ASSERT_WARNING,  false);
assert_options(ASSERT_CALLBACK, 'assert_failure');

// Make an assert that would fail
test_assert(1);

// This is never reached due to ASSERT_BAIL 
// being true
echo 'Never reached';
?>